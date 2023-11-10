<?php

namespace App\Http\Controllers;
use App\Models\Caja;
use App\Models\User;
use App\Models\Cajaventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CajaAperturaController extends Controller
{
    public function index(){
        
           
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        $cajas = Caja::where('delete_caja', 1)->where('id_empresa', $datos->empresa_id)->get();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.apertura.index',compact('cajas'));

       
    }
    public function show(Caja $caja){
        // Realiza la consulta y obtiene los resultados
        $apertura = Cajaventa::where('id_caja', $caja->id)->get();
        // Devuelve los resultados (por ejemplo, en formato JSON)
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.apertura.show', compact('apertura'));
    }
    public function create(Caja $caja){
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.apertura.create',compact('caja'));
    }
    public function store(Request $request,Caja $caja){
        $cajaventa = new Cajaventa();
        $cajaventa->id_caja=$caja->id;
        $cajaventa->id_usuario =1;
        $cajaventa->saldo_inicial=$request->saldo_inicial;
        $cajaventa->fecha_apertura = now();
        $cajaventa->delete_cajaventa = 1;
        $cajaventa->save();

        Caja::where('id', $caja->id)->update([
            'estado' => "habilitado",
        ]);
        return redirect()->route('abrir_ventas', ['cajaventa_id' => $cajaventa->id]);

    }
    public function stores(Caja $caja){
        $caja->estado="habilitado";
        $caja->save();
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.confirmado');
    }
    public function edit(){
        
    }
    public function cerrar_caja(Request $request){
        
        $montofinal = $request->input('montofinal_caja');
        Cajaventa::where('id', $request->input('id_caja_venta'))->update(['saldo_final' => $montofinal, 'fecha_cierre' => now()]);
        $caja_venta=Cajaventa::where('id', $request->input('id_caja_venta'))->select('*')->first();
        
        Caja::where('id', $caja_venta->id_caja)->update([
            'estado' => "inhabilitado",
        ]);
        return redirect()->route('apertura.index');


    }

}
