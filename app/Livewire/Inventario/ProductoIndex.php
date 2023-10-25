<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa_cliente;
use Livewire\WithPagination;

class ProductoIndex extends Component
{
  use WithPagination;

  protected $paginationTheme = "bootstrap";

  public function render()
  {
    $userId = Auth::id();

    $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
      ->where('users.id', $userId)
      ->select('*')->first();

    $empresaCliente = Empresa_cliente::find($datos->empresa_id);
    //dd($datos);
    //$productos = Producto::join('categorias', 'categorias.id', '=', 'productos.categoria_id')->where('delete_producto', 1)->where('categorias.id_empresa', $datos->empresa_id)->orderBy('productos.id', 'asc')->paginate(10);
    $productos = $empresaCliente->productos()->paginate(10);;
    //dd($productos);

    $productoIds = $productos->pluck('id');
    $stocks = Stock::join('productos', 'productos.id', '=', 'stocks.producto_id')
      ->whereIn('productos.id', $productoIds)
      ->get();
    //  dd($productos , $stocks);
    return view('livewire.inventario.producto-index', compact('productos', 'stocks'));
  }
}