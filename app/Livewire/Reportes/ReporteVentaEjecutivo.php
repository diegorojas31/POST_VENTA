<?php

namespace App\Livewire\Reportes;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\DetalleVentas;
use App\Models\Empresa_cliente;
use App\Models\Producto;
use App\Models\Ventas;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReporteVentaEjecutivo extends Component
{

    protected $listeners = ['setFromDate'];
    public $to_date;
    public $from_date;

    public function setFromDate($data)
    {
        $this->from_date = $data;
    }

    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $empresaCliente = Empresa_cliente::find($datos->empresa_id);

        $idsCajas = Caja::where('id_empresa', $datos->empresa_id)->pluck('id');

        $ventas = Ventas::whereIn('id_caja_venta', $idsCajas)->get();

        $cantidadVentas = Ventas::whereIn('id_caja_venta', $idsCajas)
            ->whereBetween('fecha_venta', [$this->from_date, $this->to_date])
            ->count();

        $sumaMontosVentas = Ventas::whereIn('id_caja_venta', $idsCajas)->whereBetween('fecha_venta', [$this->from_date, $this->to_date])->sum('montototal');

        $cantidadProductosDiferentes = DetalleVentas::whereIn('id_venta', function ($query) use ($idsCajas) {
            $query->select('id')->from('ventas')->whereIn('id_caja_venta', $idsCajas);
        })->distinct('id_producto')->count();

        $cantidadProductosDiferentes = DetalleVentas::whereIn('id_venta', function ($query) use ($idsCajas) {
            $query->select('id')->from('ventas')->whereIn('id_caja_venta', $idsCajas)
                ->whereBetween('created_at', [$this->from_date, $this->to_date]);
        })->distinct('id_producto')->count();


        $sumaCantidadDetalles = DetalleVentas::whereIn('id_venta', function ($query) use ($idsCajas) {
            $query->select('id')->from('ventas')
                ->whereIn('id_caja_venta', $idsCajas)
                ->whereBetween('created_at', [$this->from_date, $this->to_date]);
        })->sum('cantidad');


        $idProductoMasVendido = DetalleVentas::whereIn('id_venta', function ($query) use ($idsCajas) {
            $query->select('id')->from('ventas')
                ->whereIn('id_caja_venta', $idsCajas)
                ->whereBetween('created_at', [$this->from_date, $this->to_date]);
        })->groupBy('id_producto')
            ->selectRaw('id_producto, sum(cantidad) as total_cantidad')
            ->orderByDesc('total_cantidad')
            ->first();


        if ($idProductoMasVendido) {
            $idMasVendido = $idProductoMasVendido->id_producto;
        } else {
            $idMasVendido = null;
        }

        $productoMasVendido = Producto::where('id', $idMasVendido)->first();

        $idClienteMasFrecuente = Ventas::whereIn('id_caja_venta', $idsCajas)
            ->whereBetween('created_at', [$this->from_date, $this->to_date]) // Ajusta según tus necesidades
            ->groupBy('id_cliente')
            ->selectRaw('id_cliente, count(*) as total_ventas')
            ->orderByDesc('total_ventas')
            ->first();


        if ($idClienteMasFrecuente) {
            $idMasFrecuente = $idClienteMasFrecuente->id_cliente;
        } else {
            $idMasFrecuente = null;
        }

        $cliente = Cliente::where('id', $idMasFrecuente)->first();

        $cantidadClientesNuevos = Cliente::whereBetween('created_at', [$this->from_date, $this->to_date])
            ->where('empresa_id', 1) // Asegúrate de ajustar el valor de la empresa según tu lógica
            ->count();


        //dd($cantidadClientesNuevos);
        return view(
            'livewire.reportes.reporte-venta-ejecutivo',
            compact(
                'datos',
                'cantidadVentas',
                'sumaMontosVentas',
                'cantidadProductosDiferentes',
                'sumaCantidadDetalles',
                'productoMasVendido',
                'cliente',
                'cantidadClientesNuevos'
            )
        );
    }
}
