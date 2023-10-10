<?php

namespace App\Http\Controllers;

use App\Models\Cajaventa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function abrir_ventas($cajaventa_id){
        
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $caja= Cajaventa::join('cajas','cajas.id','=','cajaventas.id_caja')->where('cajaventas.id',$cajaventa_id)->select('*')->first();
        

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('ventas.index')->with('datos',$datos)->with('caja',$caja);
    }
    public function allventas_caja($caja_id){

         $ventas=0;
         

        return response()->json(['mensaje' => 'Consulta exitosa', 'ventas' => $ventas]);
    }
}
