<?php

namespace App\Livewire\Reportes\Inventario;

use App\Models\Empresa_cliente;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class Ejecutivo extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $empresaCliente = Empresa_cliente::find($datos->empresa_id);

        $totalProductos = $empresaCliente->productos()->count();

        $totalStock = $empresaCliente->productos->sum(function ($producto) {
            return $producto->stock ? $producto->stock->cantidad : 0;
        });

        $productos = $empresaCliente->productos();
        $valorTotal = 0;

        foreach ($productos as $producto) {
            $valorTotal += $producto->precio * $producto->stock->cantidad;
        }

        $productosBajos = 0;
        $productosSinStock = 0;
        $productosConStok = 0;
        $productosFull = 0;
        foreach ($productos as $producto) {
            if($producto->stock->cantidad <= $producto->stock->minimo)
                $productosBajos++;

            if ($producto->stock->cantidad == 0)
                $productosSinStock++;

            if ($producto->stock->cantidad > 0)
                $productosConStok++;

            if ($producto->stock->cantidad >= $producto->stock->maximo)
                $productosFull++;
        }



        return view('livewire.reportes.inventario.ejecutivo', compact('datos', 'totalProductos', 'totalStock', 'valorTotal', 'productosBajos', 'productosSinStock', 'productosConStok', 'productosFull'));
    }
}
