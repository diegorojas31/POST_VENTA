<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Marca;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FuncionController;

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
             //------------------------BITACORA-------------------------
             $user = User::find($userId);
             
             $ipUsuario = request()->ip();
             $activity=Activity()
                 ->causedBy($userId)
                 ->inLog($user->name)
                 ->performedOn($marca)
                 ->withProperties([
                     'inventario_id' => $marca->inventario_id,
                     'nombre' => $marca->nombre,
                     'id_empresa' => $marca->id_empresa,
                     'ip_pc' => $ipUsuario
                 ])
                 ->log('Marca Creada: '.$marca->nombre)
             ;
             $idMaster = $user->empresa_id;
             $CSV = new FuncionController;
             
             $CSV->guardarEnCSV($activity, $idMaster);
             //////////////////////////////////////////////////////////

        $this->reset(['nombre']);
        $this->dispatch('render');
        session()->flash('success', 'Marca creada con éxito.');
    }
}
