<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Caja;
use App\Models\User;
use App\Models\Stock;
use App\Models\Ventas;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Cajaventa;
use Illuminate\Http\Request;
use App\Models\DetalleVentas;
use App\Notifications\StockBajo;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class VentasController extends Controller
{
    public function abrir_ventas($cajaventa_id)
    {

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $caja = Cajaventa::join('cajas', 'cajas.id', '=', 'cajaventas.id_caja')->where('cajaventas.id', $cajaventa_id)->select('cajaventas.id as cajaventa_id', '*')->first();
        
          
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('ventas.index')->with('datos', $datos)->with('caja', $caja);
    }
    public function allventas_caja($id_cajaventa)
    {

        $cajainfo = Caja::join('cajaventas', 'cajaventas.id_caja', '=', 'cajas.id')->where('cajaventas.id', $id_cajaventa)->select()->fist();
        $datoscaja = Cajaventa::join('ventas', 'ventas.id_caja_venta', '=', 'cajaventas.id')->where('cajaventas.id', $id_cajaventa)->select('*')->get();
        return response()->json(['cajainfo' => $cajainfo, 'datoscaja' => $datoscaja]);
    }

    public function allventas()
    {

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.id_cliente')
            ->join('cajaventas', 'cajaventas.id', '=', 'ventas.id_caja_venta')
            ->join('users', 'users.id', '=', 'cajaventas.id_usuario')
            ->join('cajas', 'cajaventas.id_caja', '=', 'cajas.id')
            ->join('empresa_clientes', 'cajas.id_empresa', '=', 'empresa_clientes.id')
            ->where('empresa_clientes.id', $datos->empresa_id)
            ->select('ventas.id as id_venta', '*') // Cambia esto según las columnas que desees seleccionar
            ->get();
        //dd($ventas);


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('ventas.allventas')->with('datos', $datos)->with('ventas', $ventas);
    }

    public function buscar_producto($search)
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

    public function registrar_venta(Request $request)
    {

        // Recibe los datos de la venta del request
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $caja_id = $request->input('caja_id');
        $nombre_cliente = $request->input('nombre_cliente');
        $apellido_cliente = $request->input('apellido_cliente');
        $celular_cliente = $request->input('celular_cliente');
        $productosJSON = $request->input('productosJSON');
        $nit_cliente = $request->input('nit_cliente');
        $tipo_pago = $request->input('tipo_pago');
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


        // Crea una nueva venta
        $venta = new Ventas();
        $venta->montototal = $totalVenta;
        $venta->fecha_venta = now(); // Puedes usar Carbon para la fecha actual si lo tienes configurado
        $venta->id_caja_venta = $caja_id;
        $venta->id_cliente = $id_cliente; // Asegúrate de tener el id_cliente disponible
        $venta->id_tipo_pago = $tipo_pago; // Por defecto es activo
        $venta->save();

        $productos = json_decode($productosJSON, true);
        foreach ($productos as $producto) {
            $productostock = Producto::where('barcode', $producto['cod'])->select('*')->first();
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
                'nit_cliente' => $request->input('nit_cliente'),
                'productos' => $productosJSON,

                'ip_pc' => $ipUsuario
            ])
            ->log('Se realizo una venta por el usuario: ' . $user->name);

            $idMaster = $user->empresa_id;
            $CSV = new FuncionController;
            
            $CSV->guardarEnCSV($activity, $idMaster);
        /////////////////////////////////////////////////////////////////////////////
        
       
        return response()->json([
            'mensaje' => 'Venta registrada con éxito',
            'Ventas' => $venta
        ]);
    }
    public function generarpdfventas($idventa)
    {


        $detalle_venta = DetalleVentas::join('productos', 'productos.id', '=', 'detalle_venta.id_producto')->join('ventas', 'ventas.id', '=', 'detalle_venta.id_venta')->where('detalle_venta.id_venta', $idventa)->select('*')->get();
        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.id_cliente')->where('ventas.id', $idventa)->select('*')->first();

        //dd($detalle_venta,$ventas);


        $options = new Options();
        $options->set('chroot', realpath(''));
        $options->set('defaultFont', 'Arial');

        // Generar el HTML del boleto utilizando una vista
        $html = view('ventas.detalle_ventapdf', compact('detalle_venta', 'ventas'))->render();

        // Crear una instancia de Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');

        // Cargar el HTML del boleto
        $dompdf->loadHtml($html);

        // Renderizar el PDF
        $dompdf->render();

        // Generar el nombre del archivo PDF
        $nombreArchivo = 'venta_' . $ventas->nit_cliente . '.pdf';


        // Descargar el archivo PDF en el navegador
        return $dompdf->stream($nombreArchivo);
    }
}
