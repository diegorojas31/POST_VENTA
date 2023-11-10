<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Almacen;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa_cliente;
use App\Models\User;

class ReporteStockAnalitico extends Component
{
    public $categorias;
    public $categoriaFilter = "";

    public $unidades;
    public $unidadFilter = "";
    public $marcas;
    public $marcaFilter = "";
    public $almacenes;
    public $almacenFilter = "";

    public function mount()
    {
        $this->categorias = Categoria::all();
        $this->unidades = Medida::all();
        $this->marcas = Marca::all();
        $this->almacenes = Almacen::all();
    }
    public function render()
    {
        $marcas = Marca::all();

        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
            
        // Filtra los productos en base a la categoría seleccionada
        $products = Producto::when($this->categoriaFilter, function ($query) {
            $query->where('categoria_id', $this->categoriaFilter);
        })->when($this->unidadFilter, function ($query) {
            $query->where('medida_id', $this->unidadFilter);
        })->when($this->marcaFilter, function ($query) {
            $query->where('marca_id', $this->marcaFilter);
        })->when($this->almacenFilter, function ($query) {
            // Filtra por el almacen_id a través de la relación con Stock
            $query->whereHas('stock', function ($subquery) {
                $subquery->where('almacen_id', $this->almacenFilter);
            });
        })->get();

        

        return view('livewire.reportes.reporte-stock-analitico', compact('marcas', 'products', 'datos'));
    }
}
