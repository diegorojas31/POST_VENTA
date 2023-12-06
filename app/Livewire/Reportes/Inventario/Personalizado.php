<?php

namespace App\Livewire\Reportes\Inventario;

use App\Models\Categoria;
use App\Models\Marca;
use Livewire\Component;
use App\Models\Empresa_cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class Personalizado extends Component
{

    public $titulo;

    public $fecha;

    public $nombre;
    public $categoria;
    public $marca;
    public $medida;

    public $columasDefinidas = ['NombreProducto', 'Codigo', 'Imagen', 'Precio', 'Descripcion', 'NombreUnidad', 'Stock', 'NombreMarca', 'NombreCategoria'];
    public $columnasSeleccionadas = [];

    public function mount()
    {
        $this->titulo = "Reporte Personalizado";
        $this->fecha = Carbon::now()->format('Y-m-d');
    }
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $categorias = Categoria::where('id_empresa', $datos->empresa_id)->get();

        $marcas = Marca::where('id_empresa', $datos->empresa_id)->get();

        //$medidas = Marca::where('id_empresa', $datos->empresa_id)->get();

        /*
        Nombre | Codigo| imagen | categoria | marca | medida | stock | precio
        */

        /*$consulta = Producto::select(
            'productos.nombre as NombreProducto',
            'productos.barcode as Codigo',
            'productos.image as Imagen',
            'productos.precio as Precio',
            'productos.descripcion as Descripcion',
            'medidas.nombre as NombreUnidad',
            'stocks.cantidad as Stock',
            'marcas.nombre as NombreMarca',
            'categorias.nombre as NombreCategoria'
        )
            ->join('medidas', 'productos.medida_id', '=', 'medidas.id')
            ->leftJoin('stocks', 'productos.id', '=', 'stocks.producto_id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id');*/

        $columnas = [
            'NombreProducto' => 'productos.nombre',
            'Codigo' => 'productos.barcode',
            'Imagen' => 'productos.image',
            'Precio' => 'productos.precio',
            'Descripcion' => 'productos.descripcion',
            'NombreUnidad' => 'medidas.nombre',
            'Stock' => 'stocks.cantidad',
            'NombreMarca' => 'marcas.nombre',
            'NombreCategoria' => 'categorias.nombre'
        ];

        $columnasMostrar = collect($this->columnasSeleccionadas)
            ->map(fn($columna) => $columnas[$columna] . " as $columna")
            ->toArray();

        //dd($columnasMostrar);
        $tablaProductos = Producto::select($columnasMostrar)
            ->with(['medida', 'stock', 'marca', 'categoria'])
            ->join('medidas', 'productos.medida_id', '=', 'medidas.id')
            ->leftJoin('stocks', 'productos.id', '=', 'stocks.producto_id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->where('productos.empresa_id', $datos->empresa_id)
            ->when($this->nombre, function ($query) {
                return $query->where('productos.nombre', 'LIKE', '%' . $this->nombre . '%');
            })
            ->when($this->marca, function ($query) {
                return $query->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%');
            })
            ->when($this->medida, function ($query) {
                return $query->where('medidas.nombre', 'LIKE', '%' . $this->medida . '%');
            })
            ->when($this->categoria, function ($query) {
                return $query->where('categorias.nombre', 'LIKE', '%' . $this->categoria . '%');
            })
            ->get();

        // Aplicar filtros si las variables no son nulas o vacías
        /*if ($this->nombre) {
            $consulta->where('productos.nombre', 'LIKE', '%' . $this->nombre . '%');
        }

        if ($this->marca) {
            $consulta->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%');
        }

        if ($this->medida) {
            $consulta->where('medidas.nombre', 'LIKE', '%' . $this->medida . '%');
        }

        if ($this->categoria) {
            $consulta->where('categorias.nombre', 'LIKE', '%' . $this->categoria . '%');
        }

        $tablaProductos = $consulta->get();*/

        return view('livewire.reportes.inventario.personalizado', compact('datos', 'tablaProductos', 'categorias', 'marcas'));
    }
}
