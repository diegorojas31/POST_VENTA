<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\WithFileUploads;

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
