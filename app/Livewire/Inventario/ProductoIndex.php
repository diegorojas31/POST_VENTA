<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoIndex extends Component
{
    public function render()
    {
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        //dd($datos);
        $productos = Producto::join('categorias','categorias.id','=','productos.categoria_id')->where('delete_producto', 1)->where('categorias.id_empresa',$datos->empresa_id)->orderBy('productos.id', 'asc')->paginate(10);
        
        $productoIds = $productos->pluck('id');
        $stocks = Stock::join('productos', 'productos.id', '=', 'stocks.producto_id')
        ->whereIn('productos.id', $productoIds)
        ->get();
      //  dd($productos , $stocks);
        return view('livewire.inventario.producto-index', compact('productos', 'stocks'));
        
    }
}