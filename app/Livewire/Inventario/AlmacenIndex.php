<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Almacen;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FuncionController;

class AlmacenIndex extends Component
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


        $almacens = Almacen::where('delete_almacen', 1)
        ->where('id_empresa', $datos->empresa_id)
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);

        return view('livewire..inventario.almacen-index', compact('almacens'));
    }

    public function disable($id){
        $almacen = Almacen::find($id);
        if ($almacen ) {
            $almacen->delete_almacen = 0;
            $almacen->save();
                        //-------------------------BITACORA-------------------------
                        $userId = Auth::user()->id;
                        $user = User::find($userId);
                        $ipUsuario = request()->ip();
                        $activity=Activity()
                            ->causedBy($user->id)
                            ->inLog($user->name)
                            ->performedOn($almacen)
                            ->withProperties([
                                'nombre' => $almacen->nombre,
                                'ip_pc' => $ipUsuario
                            ])
                            ->log('Categoria: "'.$almacen->nombre.'", ELIMINADO')
                        ;
                        /////////////////////////////////////////////////////////////
                        $idMaster = $user->empresa_id;
                        $CSV = new FuncionController;
                        
                        $CSV->guardarEnCSV($activity, $idMaster);
            session()->flash('success', 'Almacen eliminado exitosamente.');
        }
    }
}
