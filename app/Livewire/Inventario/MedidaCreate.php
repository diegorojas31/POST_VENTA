<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Medida;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MedidaCreate extends Component
{

    public $nombre;
    public $descripcion;
    public $abreviatura;

    protected $rules = [
        'nombre' => 'required|max:50',
        'descripcion' => 'max:150',
        'abreviatura' => 'required|max:5',
    ];

    public function render()
    {
        return view('livewire.inventario.medida-create');
    }

    public function save()
    {
        $this->validate();
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $medida = new Medida();
        $medida->inventario_id = 1;
        $medida->nombre = $this->nombre;
        $medida->descripcion = $this->descripcion;
        $medida->abreviatura = $this->abreviatura;
        $medida->id_empresa = $datos->empresa_id;
        $medida->save();

        $this->reset(['nombre', 'descripcion', 'abreviatura']);
        $this->dispatch('render');
    }
}
