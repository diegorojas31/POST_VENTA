<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Ventas;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Empresa_cliente;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        $rol = Role::find($datos->rol_id);


        if ($rol->name !== 'Master') {
            return redirect()->route('apertura.index');
        }
        $cantusers = User::where('empresa_id', $datos->empresa_id)->count();

        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.id_cliente')
            ->join('cajaventas', 'cajaventas.id', '=', 'ventas.id_caja_venta')
            ->join('users', 'users.id', '=', 'cajaventas.id_usuario')
            ->join('cajas', 'cajaventas.id_caja', '=', 'cajas.id')
            ->join('empresa_clientes', 'cajas.id_empresa', '=', 'empresa_clientes.id')
            ->where('empresa_clientes.id', $datos->empresa_id)
            ->select('ventas.id as id_venta', '*') // Cambia esto según las columnas que desees seleccionar
            ->get();

            
        
        $cantidadVentas = $ventas->count();
        $totalVentas = $ventas->sum('montototal');
        $productos= Producto::join('detalle_venta','detalle_venta.id_producto','=','productos.id')->where('productos.empresa_id',$datos->empresa_id)->select('*')->get();

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('home')->with('datos', $datos)->with('cant_users', $cantusers)->with('cant_ventas',$cantidadVentas)
        ->with('total_ventas',$totalVentas)->with('productos_vendidos',$productos);
    }
}
