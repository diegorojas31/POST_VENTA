<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use Livewire\Component;

use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CategoriaIndex extends Component
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
        // dd($datos);

        //$categorias = Categoria::where('delete_categoria', 1)->where('id_empresa',$datos->empresa_id)->orderBy('id', 'asc')->paginate(10);
        $categorias = Categoria::where('delete_categoria', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.inventario.categoria-index', compact('categorias'));
    }
}
