<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa_cliente;
use App\Models\User;
use App\Models\Producto;

class ReporteStockEjecutivo extends Component
{

    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $empresaCliente = Empresa_cliente::find($datos->empresa_id);

        $productos = Producto::all();
       // dd($productos);

        // Calcular la cantidad total de productos en stock
        $cantidadTotalEnStock = 0;


        foreach ($productos as $producto) {
            $cantidadTotalEnStock += $producto->stock->cantidad;
        }

        $cantidadProductosSinStock = $productos->where('stock.cantidad', 0)->count();

        // dd($cantidadTotalEnStock);

        $cantidadProductosConStock = $productos->where('stock.cantidad', '>', 0)->count();

        $valorTotalProductos = 0;

        foreach ($productos as $producto) {
            $cantidadTotalEnStock += $producto->stock->cantidad;
            $valorTotalProductos += $producto->precio * $producto->stock->cantidad;

            if ($producto->stock->cantidad == 0) {
                $cantidadProductosSinStock++;
            } else {
                $cantidadProductosConStock++;
            }
        }


        return view('livewire.reportes.reporte-stock-ejecutivo', compact('datos', 'productos', 'cantidadTotalEnStock', 'cantidadProductosSinStock', 'cantidadProductosConStock', 'valorTotalProductos'));
    }
}
