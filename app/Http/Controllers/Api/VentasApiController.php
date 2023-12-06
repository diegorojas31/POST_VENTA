<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Stock;
use App\Models\Ventas;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\DetalleVentas;
use App\Notifications\StockBajo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Controllers\FuncionController;

class VentasApiController extends Controller
{
    public function buscar_producto_api($search)
    {

        $producto = Producto::join('stocks', 'stocks.producto_id', '=', 'productos.id')
            ->where(function ($query) use ($search) {
                $query->where('productos.barcode', '=', $search)
                    ->orWhere('productos.nombre', 'like', '%' . $search . '%');
            })->where('productos.delete_producto',1)
            ->select('stocks.id as stock_id', '*')
            ->get();


        if ($producto) {
            return response()->json($producto); // Retorna el resultado como JSON
        } else {
            return response()->json(['error' => 'Producto no encontrado']);
        }
    }
    public function registrar_venta_api(Request $request)
    {

        
        $userId = 1;
        
        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        

        $caja_id = 1;
        $nombre_cliente = $request->nombre_cliente;
        $apellido_cliente = $request->apellido_cliente;
        $celular_cliente = $request->celular_cliente;
        $productosJSON = $request->productosJSON;
        $nit_cliente = $request->nit_cliente;
        $tipo_pago = 1;
        $totalVenta = $request->total_venta;

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



        // Crea una nueva venta
        $venta = new Ventas();
        $venta->montototal = 30000.00;
        $venta->fecha_venta = now(); // Puedes usar Carbon para la fecha actual si lo tienes configurado
        $venta->id_caja_venta = $caja_id;
        $venta->id_cliente = $id_cliente; // Asegúrate de tener el id_cliente disponible
        $venta->id_tipo_pago = $tipo_pago; // Por defecto es activo
        $venta->save();


        

        $productos = json_decode($productosJSON, true);
        foreach ($productos as $producto) {
            $productostock = Producto::where('barcode', $producto['codigo'])->select('*')->first();
            $detalleVenta = new DetalleVentas();
            $detalleVenta->subtotal = $productostock->precio * $producto['cantidad'];
            $detalleVenta->cantidad = $producto['cantidad'];
            $detalleVenta->id_producto = $productostock->id;
            $detalleVenta->id_venta = $venta->id;
            $detalleVenta->save();

            // Actualiza el stock

            $cantidad_a_restar = $producto['cantidad'];

            Stock::where('producto_id', $productostock->id)
                ->update(['cantidad' => DB::raw("cantidad - $cantidad_a_restar")]);

            // Ahora, para obtener el nuevo valor de cantidad, puedes hacer una nueva consulta
            $stock_new = Stock::where('producto_id', $productostock->id)->select('*')->first();
            $producto_new = Producto::where('id', $productostock->id)->select('*')->first();

            if ($stock_new->cantidad <= $stock_new->minimo) {

                

                $id_administradores = User::where('users.empresa_id', $datos->empresa_id)->get();

                foreach ($id_administradores as $administrador) {

                    $administrador->notify(new StockBajo($producto_new, $stock_new));
                }
            }
        }
        //---------------------------------------BITACORA---------------------------
        

        $user = User::find($userId);
        $ipUsuario = request()->ip();
        $activity=Activity()
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn($venta)
            ->withProperties([
                'monto_total' => $venta->montototal,
                'nit_cliente' => $request->nit_cliente,
                'productos' => $productosJSON,

                'ip_pc' => $ipUsuario
            ])
            ->log('Se realizo una venta por el usuario DESDE LA APLICACION: ' . $user->name);

            $idMaster = $user->empresa_id;
            $CSV = new FuncionController;
            
            $CSV->guardarEnCSV($activity, $idMaster);
        /////////////////////////////////////////////////////////////////////////////
        
       
        
        return response()->json([
            'mensaje' => 'Venta registrada con éxito',
            'Ventas' => $venta
        ], 200);
        
    }
    public function all_cajas_api(){

    }
}
