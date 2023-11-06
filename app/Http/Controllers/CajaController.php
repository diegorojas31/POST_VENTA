<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Cajaventa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    public function index()
    {




        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        //dd($datos);
        $cajas = Caja::where('delete_caja', 1)->where('id_empresa', $datos->empresa_id)->get();

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.index', compact('cajas'));
        //return view('caja.index');
    }
    public function create()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.create');
    }
    public function store(Request $request)
    {
        //return $request->all();
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('empresa_clientes.id as id_empresa')->first();

        $caja = new Caja();
        $caja->title_caja = $request->nombrecaja;
        $caja->estado = "inhabilitado";
        $caja->id_empresa = $datos->id_empresa;
        $caja->save();

        
        // --------------------------------BITACORA /-----------------------
        
        $usuario = User::find($userId); 
        $ipUsuario = request()->ip();
        activity()
        ->performedOn($caja)
        ->causedBy($userId)
        ->inLog($usuario->name)
        ->withProperties([
            'name' => $caja->title_caja,
            'ip_usuario' => $ipUsuario 
        ])
        ->log('Nueva Caja creada: '.$caja->title_caja);
        ///////////////////////////////////////////////////////////////////

        return redirect()->route('caja.show', $caja->id);
    }
    public function show($id)
    {
        $cajas = Caja::find($id);
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);

        return view('caja.show', compact('cajas'));
    }
    public function edit(Caja $caja)
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.edit', compact('caja'));
    }
    public function update(Request $request, Caja $caja)
    {
        $caja->title_caja = $request->nombrecaja;
        $caja->estado = $request->estado;
        $caja->save();



        $userId = Auth::id();
        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

                    ///////////////////////////////////////////////////////////
        //---------------------------BITACORA----------------------
        $ipUsuario = request()->ip();
        $user = User::find($userId);
        Activity()
            ->causedBy($userId) //id usuario
            ->inLog($user->name)  //nombre del usuario
            ->performedOn(Caja::find($caja->id)) //id de caja
            ->withProperties([
                'caja_anterior' => $caja->title_caja,
                'caja_actualizada' => $request->nombrecaja,
                'ip_pc' => $ipUsuario
            ])
            ->log('Se actualizo la caja "'.$caja->title_caja.'" a "'.$request->nombrecaja.'"')
        ;
        ///////////////////////////////////////////////////////////


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.confirmado');
    }
    public function destroy($id)
    {

        $userId = Auth::user();

        Caja::where('id', $id)->where('estado', 'inhabilitado')->update([
            'delete_caja' => 0,
        ]);
                //------------------------BITACORA------------------------------
                $user = User::find($userId);
                $caja = Caja::find($id);
                $ipUsuario = request()->ip();
                Activity()
                    ->causedBy($user->id)
                    ->inLog($user->name)   
                    ->performedOn($caja)
                    ->withProperties([
                        'title_caja' => $caja->title_caja,
                        'ip_pc' => $ipUsuario
                    ])
                    ->Log('Caja: '.$caja->name.', ELIMINADA')
                ;
                /////////////////////////////////////////////////////////////////

        return redirect()->route('caja.index');
        // DB::beginTransaction();
        // try {
        //     $caja->delete();
        //     DB::commit();

        //     return view('caja.eliminado');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return "error";
        // }
    }

    public function obtener_datos_cajaventa($id_cajaventa)
    {

        $cajainfo = Caja::join('cajaventas', 'cajaventas.id_caja', '=', 'cajas.id')->where('cajaventas.id', $id_cajaventa)->select('cajaventas.id as id_cajaventa','*')->first();

        $datoscaja = Cajaventa::join('ventas', 'ventas.id_caja_venta', '=', 'cajaventas.id')->where('cajaventas.id', $id_cajaventa)->select('*')->get();
        // Calcula la suma de los montos totales de las ventas
        $sumaMontosTotales = $datoscaja->sum('montototal');

        $montofinal=$sumaMontosTotales +$cajainfo->saldo_inicial;
        return response()->json(['cajainfo' => $cajainfo, 'datoscaja' => $datoscaja, 'montofinal' => $montofinal]);
    }
}
