<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Medida;
use Livewire\WithPagination;

class MedidaIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $medidas = Medida::where('delete_medida', 1)->orderBy('id', 'asc')->paginate(10);
        return view('livewire.inventario.medida-index', compact('medidas'));
    }
}
