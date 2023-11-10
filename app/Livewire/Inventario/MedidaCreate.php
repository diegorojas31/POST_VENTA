<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Medida;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FuncionController;

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

          //---------------------------------BITACORA-------------------------------
          $user = User::find($userId);
                
          $ipUsuario = request()->ip();
          $activity=Activity()
              ->causedBy($user->id)
              ->inLog($user->name)
              ->performedOn($medida)
              ->withProperties([
                  'inventario_id' => $medida->inventario_id,
                  'nombre' => $medida->nombre,
                  'descripcion' => $medida->descripcion,
                  'abreviatura' => $medida->abreviatura,
                  'id_empresa' => $medida->id_empresa,
                  'ip_pc' => $ipUsuario
              ])
              ->log('Nueva Medida creada: '.$medida->nombre)
          ;

          $idMaster = $user->empresa_id;
          $CSV = new FuncionController;
          
          $CSV->guardarEnCSV($activity, $idMaster);
          ////////////////////////////////////////////////////////////////////////////

        $this->reset(['nombre', 'descripcion', 'abreviatura']);
        $this->dispatch('render');
    }
}
