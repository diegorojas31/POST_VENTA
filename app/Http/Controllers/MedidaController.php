<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.medida.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.medida.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'max:150',
            'abreviatura' => 'required|max:5',
        ]);

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
        ->where('users.id', $userId)
        ->select('*')->first();

        $medida = new Medida();
        $medida->inventario_id = 1;
        $medida->nombre = $request->input('nombre');
        $medida->descripcion = $request->input('descripcion');
        $medida->abreviatura = $request->input('abreviatura');
        $medida->id_empresa = $datos->empresa_id;

        $medida->save();
                //---------------------------------BITACORA-------------------------------
                $user = User::find($userId);
                
                $ipUsuario = request()->ip();
                $activity=Activity()
                    ->causedBy($user->id)
                    ->inLog($user->name)
                    ->performedOn($medida)
                    ->withProperties([
                        'inventario_id' => $medida->inventario_id,
                        'nombre' => $medida->nombre,
                        'descripcion' => $medida->descripcion,
                        'abreviatura' => $medida->abreviatura,
                        'id_empresa' => $medida->id_empresa,
                        'ip_pc' => $ipUsuario
                    ])
                    ->log('Nueva Medida creada: '.$medida->nombre)
                ;

                $idMaster = $user->empresa_id;
                $CSV = new FuncionController;
                
                $CSV->guardarEnCSV($activity, $idMaster);
                ////////////////////////////////////////////////////////////////////////////

        return redirect()->route('medidas.create')->with('info', 'Unidad de Medida creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medida $medida)
    {
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.medida.edit', compact('medida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medida $medida)
    {
        //
        $request->validate([
            'nombre' => 'required|max:50|unique:medidas,nombre,' . $medida->id,
            'descripcion' => 'max:150',
            'abreviatura' => 'required|max:5|unique:medidas,abreviatura,' . $medida->id
        ]);
        $preMedida = $medida->nombre; 
        $medida->update($request->all());
         //---------------------------------BITACORA------------------------
         $userId = Auth::id();
         $user = User::find($userId);
         
         $ipUsuario = request()->ip();
         
         $activity=Activity()
             ->causedBy($user->id)
             ->inLog($user->name)
             ->performedOn($medida)
             ->withProperties([
                 'preMedida' => $preMedida->nombre,
                 'preDescripcion' => $preMedida->descripcion,
                 'preAbreviatura' => $preMedida->Abreviatura,
                 'Medida' => $medida->nombre,
                 'descripcion' => $medida->descripcion,
                 'abreviatura' => $medida->abreviatura,
                 'ip_pc' => $ipUsuario
             ])
             ->log('Medida Actualizado de "'.$preMedida.'" a "'.$medida->nombre.'"')
         ;
         $idMaster = $user->empresa_id;
         $CSV = new FuncionController;
         
         $CSV->guardarEnCSV($activity, $idMaster);
         ///////////////////////////////////////////////////////////////////

        return redirect()->route('medidas.edit', $medida)->with('info', 'La Unidad de medida se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medida $medida)
    {
        //
        if ($medida->productos->where('delete_producto', 1)->isEmpty()) {
            $medida->delete_medida = 0;
            $medida->save();

                        //-----------------------BITACORA----------------------------
                        $userId = Auth::id();
                        $user = User::find($userId);
                        
                        $ipUsuario = request()->ip();
                        $activity=Activity()
                            ->causedBy($user->id)
                            ->inLog($user->name)
                            ->performedOn($medida)
                            ->withProperties([
                                'nombre' => $medida->nombre,
                                'ip_pc' => $ipUsuario
                            ])
                            ->log('medida: '.$medida->nombre.', ELIMANADA')
                        ;
                        /////////////////////////////////////////////////////////////

                        $idMaster = $user->empresa_id;
                        $CSV = new FuncionController;
                        
                        $CSV->guardarEnCSV($activity, $idMaster);

            return redirect()->route('medidas.index')->with('info', 'Unidad de Medida Eliminada con éxito.');
        } else {
            return redirect()->route('medidas.index')->with('error', 'No se puede eliminar una Unidad de Medida con productos relacionados.');
        }
    }
}