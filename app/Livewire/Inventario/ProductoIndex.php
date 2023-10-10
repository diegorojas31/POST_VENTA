<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Stock;

class ProductoIndex extends Component
{
    public function render()
    {
        $productos = Producto::where('delete_producto', 1)->orderBy('id', 'asc')->paginate(10);
        $stocks = Stock::all();

        return view('livewire.inventario.producto-index', compact('productos', 'stocks'));
    }
}