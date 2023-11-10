<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FuncionController;

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
                        //-------------------------BITACORA-------------------------
                        $userId = Auth::user()->id;
                        $user = User::find($userId);
                        $ipUsuario = request()->ip();
                        $activity=Activity()
                            ->causedBy($user->id)
                            ->inLog($user->name)
                            ->performedOn($marca)
                            ->withProperties([
                                'nombre' => $marca->nombre,
                                'ip_pc' => $ipUsuario
                            ])
                            ->log('Marca: "'.$marca->nombre.'", ELIMINADO')
                        ;
                        $idMaster = $user->empresa_id;
                        $CSV = new FuncionController;
                        
                        $CSV->guardarEnCSV($activity, $idMaster);
                        /////////////////////////////////////////////////////////////
            session()->flash('success', 'Marca deshabilitada exitosamente.');
        }
    }
}
