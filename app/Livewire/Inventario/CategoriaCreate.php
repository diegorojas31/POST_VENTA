<?php

namespace App\Livewire\Inventario;

use App\Models\User;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FuncionController;

class CategoriaCreate extends Component
{
    use WithFileUploads;

    public $nombre;
    public $descripcion;
    public $file;

    public $imagePath;

    protected $rules = [
        'nombre' => 'required|unique:categorias|max:50',
        'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ];


    public function render()
    {
        return view('livewire.inventario.categoria-create');
    }

    public function save()
    {
        $this->validate();

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $categoria = new Categoria();
        $categoria->inventario_id = 1;
        $categoria->nombre = $this->nombre;
        $categoria->descripcion = $this->descripcion;
        $categoria->image = 'images/no-image.png';
        $categoria->id_empresa = $datos->empresa_id;

        if ($this->file) {
            $url = Storage::put('categorias', $this->file);
            $categoria->image = 'storage/public/' . $url;
        }

        $categoria->save();

         //------------------------BITACORA-------------------------
         $user = User::find($userId);

         $ipUsuario = request()->ip();
         $activity=Activity()
             ->causedBy($userId)
             ->inLog($user->name)
             ->performedOn($categoria)
             ->withProperties([
                 'inventario_id' => $categoria->inventario_id,
                 'nombre' => $categoria->nombre,
                 'descripcion' => $categoria->descripcion,
                 'id_empresa' => $categoria->id_empresa,
                 'ip_pc' => $ipUsuario
             ])
             ->log('Categoria Creada: ' . $categoria->nombre);
         //////////////////////////////////////////////////////////
 
         $idMaster = $user->empresa_id;
         $CSV = new FuncionController;
         
         $CSV->guardarEnCSV($activity, $idMaster);

        $this->reset(['nombre', 'descripcion', 'file']);
        $this->dispatch('render');
    }

    public function updatedFile()
    {
        if ($this->file) {
            $this->imagePath = $this->file->temporaryUrl();
        }
    }
}
