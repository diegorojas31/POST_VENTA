<?php

namespace App\Livewire\Reportes;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\DetalleVentas;
use App\Models\Empresa_cliente;
use App\Models\Producto;
use App\Models\Ventas;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReporteVentaAnalitico extends Component
{

    public $from_date = "2023-12-04";
    public $to_date = "2023-12-04";

    public function mount()
    {
        $this->from_date = Carbon::now()->format('Y-m-d');
        $this->to_date = Carbon::now()->format('Y-m-d');
    }
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $allVentas = Ventas::select(
            'ventas.id as nro',
            'ventas.fecha_venta as FechaVenta',
            'empleados.nombre_empleado as Vendedor',
            'clientes.nombre_cliente as Cliente',
            'ventas.montototal as MontoTotal'
        )
            ->join('cajas', 'ventas.id_caja_venta', '=', 'cajas.id')
            ->join('cajaventas', 'cajas.id', '=', 'cajaventas.id_caja')
            ->join('empleados', 'cajaventas.id_usuario', '=', 'empleados.id')
            ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id')
            ->where('cajas.id_empresa', $datos->empresa_id)
            ->whereBetween('ventas.fecha_venta', [$this->from_date, $this->to_date])
            ->get();




        $productosMasVendidos = Producto::select(
            'productos.nombre as ProductoNombre',
            DB::raw('SUM(detalle_venta.cantidad) as CantidadTotal')
        )
            ->join('detalle_venta', 'productos.id', '=', 'detalle_venta.id_producto')
            ->join('ventas', 'detalle_venta.id_venta', '=', 'ventas.id')
            ->where('productos.empresa_id', $datos->empresa_id)
            ->whereBetween('ventas.created_at', [$this->from_date, $this->to_date])
            ->groupBy('productos.id', 'productos.nombre')
            ->take(10)
            ->get();

          //  dd($productosMasVendidos);


        return view('livewire.reportes.reporte-venta-analitico', compact('datos', 'allVentas', 'productosMasVendidos'));
    }
}
