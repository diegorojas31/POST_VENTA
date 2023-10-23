<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use App\Models\Producto;
use App\Models\Cajaventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function abrir_ventas($cajaventa_id){
        
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $caja= Cajaventa::join('cajas','cajas.id','=','cajaventas.id_caja')->where('cajaventas.id',$cajaventa_id)->select('cajaventas.id as cajaventa_id','*')->first();
        

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('ventas.index')->with('datos',$datos)->with('caja',$caja);
    }
    public function allventas_caja($id_cajaventa){

        $cajainfo= Caja::join('cajaventas','cajaventas.id_caja','=','cajas.id')->where('cajaventas.id',$id_cajaventa)->select()->fist();
        $datoscaja=Cajaventa::join('ventas','ventas.id_caja_venta','=','cajaventas.id')->where('cajaventas.id',$id_cajaventa)->select('*')->get();
        return response()->json(['cajainfo' => $cajainfo, 'datoscaja' => $datoscaja]);
    }

    public function buscar_producto($search){

        $producto = Producto::join('stocks', 'stocks.producto_id', '=', 'productos.id')
        ->where(function($query) use($search) {
            $query->where('productos.barcode', '=', $search)
                  ->orWhere('productos.nombre', 'like', '%' . $search . '%');
        })
        ->select('stocks.id as stock_id','*')
        ->first();


        if ($producto) {
            return response()->json($producto); // Retorna el resultado como JSON
        } else {
            return response()->json(['error' => 'Producto no encontrado']); 
        }
    }
}
