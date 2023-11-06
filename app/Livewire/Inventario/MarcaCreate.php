<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Marca;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MarcaCreate extends Component
{
    public $nombre;

    protected $rules = [
        'nombre' => 'required|max:100',
    ];

    public function render()
    {
        return view('livewire.inventario.marca-create');
    }

    public function save(){
        $this->validate();
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
        ->where('users.id', $userId)
            ->select('*')->first();

        $marca = new Marca();
        $marca->inventario_id = 1;
        $marca->nombre = $this->nombre;
        $marca->id_empresa = $datos->empresa_id;
        $marca->save();

        $this->reset(['nombre']);
        $this->dispatch('render');
        session()->flash('success', 'Marca creada con éxito.');
    }
}
