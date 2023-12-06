<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stock;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use App\Models\DetalleCotizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
    public function abrir_registrar_cotizacion()
    {

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('cotizaciones.registrar_cotizacion')->with('datos', $datos);
    }

    public function registrar_cotizacion(Request $request)
    {

        // Recibe los datos de la venta del request
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        
        $nombre_cliente = $request->input('nombre_cliente');
        $apellido_cliente = $request->input('apellido_cliente');
        $celular_cliente = $request->input('celular_cliente');
        $productosJSON = $request->input('productosJSON');
        $nit_cliente = $request->input('nit_cliente');
        $totalVenta = $request->input('totalVenta');

        $id_cliente = Cliente::where('nit_cliente', $nit_cliente)->where('empresa_id', $datos->empresa_id)->value('id');
        if (!$id_cliente) {
            // Crea una nueva vent

            $cliente = new Cliente();
            $cliente->nombre_cliente = $nombre_cliente;
            $cliente->apellido_cliente = $apellido_cliente; // Puedes usar Carbon para la fecha actual si lo tienes configurado
            $cliente->nit_cliente = $nit_cliente;
            $cliente->celular_cliente = $celular_cliente; // Asegúrate de tener el id_cliente disponible
            $cliente->empresa_id = $datos->empresa_id;
            $cliente->save();

            //--------------------------------BITACORA-----------------------
            
            $user = User::find($userId);
            $ipUsuario = request()->ip();
            $activity=Activity()
                ->causedBy($user->id)
                ->inLog($user->name)
                ->performedOn($cliente)
                ->withProperties([
                    'nit_cliente' => $cliente->nit_cliente,
                    'nombre_cliente' => $cliente->nombre_cliente,
                    'apellido_cliente' => $cliente->apellido_cliente,
                    'ip_pc'=>$ipUsuario
                ])
                ->log('Cliente Creado: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente);

                $idMaster = $user->empresa_id;
                $CSV = new FuncionController;
                
                $CSV->guardarEnCSV($activity, $idMaster);
            /////////////////////////////////////////////////////////////////

            $id_cliente = $cliente->id;
        }

/* -------------------------------------------------------------------------
---------------AQUI ME QUEDEEEEEE---------------------------------------------
----------------------------------------------------------------------------------*/
        // EDITAR QUE REGISTRE LA COTIZACION 
        $cotizacion = new Cotizacion();
        $cotizacion->montototal = $totalVenta;
        $cotizacion->fecha_cotizacion = now(); // Puedes usar Carbon para la fecha actual si lo tienes configurado
        $cotizacion->id_usuario = $userId;
        $cotizacion->id_cliente = $id_cliente; // Asegúrate de tener el id_cliente disponible
        $cotizacion->fecha_limitecot = now();
        $cotizacion->save();

        $productos = json_decode($productosJSON, true);
        foreach ($productos as $producto) {
            $productostock = Producto::where('barcode', $producto['cod'])->select('*')->first();
            $detalleCotizacion = new DetalleCotizacion();
            $detalleCotizacion->subtotal = $productostock->precio * $producto['cantidad'];
            $detalleCotizacion->cantidad = $producto['cantidad'];
            $detalleCotizacion->id_producto = $productostock->id;
            $detalleCotizacion->id_cotizacion = $cotizacion->id;
            $detalleCotizacion->save();

           
        //---------------------------------------BITACORA---------------------------
        

        $user = User::find($userId);
        $ipUsuario = request()->ip();
        $activity=Activity()
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn($cotizacion)
            ->withProperties([
                'monto_total' => $cotizacion->montototal,
                'nit_cliente' => $request->input('nit_cliente'),
                'productos' => $productosJSON,

                'ip_pc' => $ipUsuario
            ])
            ->log('Se realizo una Cotizacion por el usuario: ' . $user->name);

            $idMaster = $user->empresa_id;
            $CSV = new FuncionController;
            
            $CSV->guardarEnCSV($activity, $idMaster);
        /////////////////////////////////////////////////////////////////////////////
        
       
        return response()->json([
            'mensaje' => 'Cotizacion registrada con éxito',
            'Cotizacion' => $cotizacion
        ]);
    }
}
}
