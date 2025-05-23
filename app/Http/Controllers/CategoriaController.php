<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|unique:categorias|max:50',
            'file' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $categoria = new Categoria();
        $categoria->inventario_id = 1;
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->image = 'images/no-image.png';
        $categoria->id_empresa = $datos->empresa_id;

        if ($request->file('file')) {
            $url = Storage::put('categorias', $request->file('file'));
            $categoria->image = 'storage/' . $url;
        }

        $categoria->save();

        //------------------------BITACORA-------------------------
        $user = User::find($userId);

        $ipUsuario = request()->ip();
        $activity=Activity()
            ->causedBy($userId)
            ->inLog($user->name)
            ->performedOn($categoria)
            ->withProperties([
                'inventario_id' => $categoria->inventario_id,
                'nombre' => $categoria->nombre,
                'descripcion' => $categoria->descripcion,
                'id_empresa' => $categoria->id_empresa,
                'ip_pc' => $ipUsuario
            ])
            ->log('Categoria Creada: ' . $categoria->nombre);
        //////////////////////////////////////////////////////////

        $idMaster = $datos->id_empresa;
        $CSV = new FuncionController;
        
        $CSV->guardarEnCSV($activity, $idMaster);

        return redirect()->route('categorias.create')->with('info', 'Categoria creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Valida el nombre, pero excluye el nombre actual del registro actual
        $request->validate([
            'nombre' => 'required|max:50|unique:categorias,nombre,' . $categoria->id,
            'file' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $preNombre = $categoria->nombre;

        $categoria->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('categorias', $request->file('file'));
            $categoria->image = 'storage/' . $url;
        }


        $categoria->save();

        //--------------------------------BITACORA-------------------------------
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $ipUsuario = request()->ip();
        $activity=Activity()
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn($categoria)
            ->withProperties([
                'pre_nombre' => $preNombre,
                'nombre' => $categoria->nombre,
                'image' => $categoria->image,
                'ip_pc' => $ipUsuario
            ])
            ->log('Categoria Actualizada de "' . $preNombre . '" a "' . $categoria->nombre . '"');
        /////////////////////////////////////////////////////////////////////////

        $idMaster = $user->empresa_id;
        $CSV = new FuncionController;
        
        $CSV->guardarEnCSV($activity, $idMaster);

        return redirect()->route('categorias.edit', $categoria)->with('info', 'La categoría se actualizó con éxito.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
        if ($categoria->productos->where('delete_producto', 1)->isEmpty()) {
            $categoria->delete_categoria = 0;
            $categoria->save();

            //-------------------------BITACORA-------------------------
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $ipUsuario = request()->ip();
            $activity= Activity()
                ->causedBy($user->id)
                ->inLog($user->name)
                ->performedOn($categoria)
                ->withProperties([
                    'nombre' => $categoria->nombre,
                    'ip_pc' => $ipUsuario
                ])
                ->log('Categoria: "' . $categoria->nombre . '", ELIMINADO');
            /////////////////////////////////////////////////////////////
            $idMaster = $user->empresa_id;
            $CSV = new FuncionController;
            
            $CSV->guardarEnCSV($activity, $idMaster);
            return redirect()->route('categorias.index')->with('info', 'Categoria Eliminada con éxito.');
        } else {
            return redirect()->route('categorias.index')->with('error', 'No se puede eliminar una categoría con productos relacionados.');
        }
    }
}
