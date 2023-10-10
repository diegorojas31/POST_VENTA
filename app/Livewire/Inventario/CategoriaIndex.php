<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Categoria;

use Livewire\WithPagination;

class CategoriaIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = "Busqueda";

    public function render()
    {
        $categorias = Categoria::where('delete_categoria', 1)->orderBy('id', 'asc')->paginate(10);
        return view('livewire.inventario.categoria-index', compact('categorias'));
    }
}
