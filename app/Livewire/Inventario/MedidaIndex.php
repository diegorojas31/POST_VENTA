<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Medida;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MedidaIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = '';

    protected $listeners = ['render' => 'render'];
    
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $medidas = Medida::where('delete_medida', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);
            
        return view('livewire.inventario.medida-index', compact('medidas'));
    }
}
