<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Almacen;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AlmacenCreate extends Component
{
    public $nombre;
    public $descripcion;

    protected $rules = [
        'nombre' => 'required|unique:almacens|max:100',
    ];

    public function render()
    {
        return view('livewire..inventario.almacen-create');
    }

    public function save()
    {
        $this->validate();
        
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $almacen = new Almacen();
        $almacen->inventario_id = 1;
        $almacen->nombre = $this->nombre;
        $almacen->descripcion = $this->descripcion;
        $almacen->id_empresa = $datos->empresa_id;
        $almacen->save();
                //------------------------BITACORA-------------------------
                $user = User::find($userId);
                
                $ipUsuario = request()->ip();
                Activity()
                    ->causedBy($userId)
                    ->inLog($user->name)
                    ->performedOn($almacen)
                    ->withProperties([
                        'inventario_id' => $almacen->inventario_id,
                        'nombre' => $almacen->nombre,
                        'descripcion' => $almacen->descripcion,
                        'id_empresa' => $almacen->id_empresa,
                        'ip_pc' => $ipUsuario
                    ])
                    ->log('Almacen Creado: '. $almacen->nombre)
                ;
                //////////////////////////////////////////////////////////

        $this->reset(['nombre', 'descripcion']);
        $this->dispatch('render');
        session()->flash('success', 'Almacen creado con éxito.');
    }
}
