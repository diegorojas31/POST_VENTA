<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Marca;

class MarcaIndex extends Component
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


        $marcas = Marca::where('delete_marca', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);

        return view('livewire..inventario.marca-index', compact('marcas'));
    }

    public function disable($id)
    {
        $marca = Marca::find($id);
        if ($marca) {
            $marca->delete_marca = 0;
            $marca->save();
            session()->flash('success', 'Marca deshabilitada exitosamente.');
        }
    }
}
