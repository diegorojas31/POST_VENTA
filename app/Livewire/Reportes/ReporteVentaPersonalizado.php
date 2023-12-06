<?php

namespace App\Livewire\Reportes;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Empleados;
use App\Models\User;
use App\Models\Ventas;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class ReporteVentaPersonalizado extends Component
{
    public $titulo;

    public $fecha;

    public $caja;

    public $empleado;

    public $cliente;

    public $from_date;

    public $to_date;

    public $conclu;

    public $columasDefinidas = ['NroVenta', 'FechaVenta', 'Vendedor', 'Cliente', 'Caja', 'MontoTotal'];
    public $columnasSeleccionadas = [];

    public function mount()
    {
        $this->titulo = "Reporte Personalizado";
        $this->fecha = Carbon::now()->format("Y-m-d");

        $this->from_date = Carbon::now()->format("Y-m-d");
        $this->to_date = Carbon::now()->format("Y-m-d");
    }



    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $cajas = Caja::where('id_empresa', $datos->empresa_id)->get();

        $empleados = Empleados::whereHas('usuario', function ($query) use ($datos) {
            $query->where('empresa_id', $datos->empresa_id);
        })->get();

        $clientes = Cliente::where('empresa_id', $datos->empresa_id)->get();

//$categorias = Categoria::where('id_empresa', $datos->empresa_id)->get();
        /*$allVentas = Ventas::select(
            'ventas.id as NroVenta',
            'ventas.fecha_venta as FechaVenta',
            'empleados.nombre_empleado as Vendedor',
            'clientes.nombre_cliente as Cliente',
            'cajas.title_caja as Caja',
            'ventas.montototal as MontoTotal'
        )
            ->join('cajas', 'ventas.id_caja_venta', '=', 'cajas.id')
            ->join('cajaventas', 'cajas.id', '=', 'cajaventas.id_caja')
            ->join('empleados', 'cajaventas.id_usuario', '=', 'empleados.id')
            ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id')
            ->where('cajas.id_empresa', $datos->empresa_id)
            ->where('cajas.id', 1) // Agrega la condición para el ID de la caja
            ->whereBetween('ventas.fecha_venta', [$this->from_date, $this->to_date])
            ->get();*/

        $columnas = [
            'NroVenta' => 'ventas.id',
            'FechaVenta' => 'ventas.fecha_venta',
            'Vendedor' => 'empleados.nombre_empleado',
            'Cliente' => 'clientes.nombre_cliente',
            'Caja' => 'cajas.title_caja',
            'MontoTotal' => 'ventas.montototal',
        ];

        $columnasMostrar = collect($this->columnasSeleccionadas)
            ->map(fn($columna) => $columnas[$columna] . " as $columna")
            ->toArray();

        $tablaVentas = Ventas::select($columnasMostrar)
            ->join('cajas', 'ventas.id_caja_venta', '=', 'cajas.id')
            ->join('cajaventas', 'cajas.id', '=', 'cajaventas.id_caja')
            ->join('empleados', 'cajaventas.id_usuario', '=', 'empleados.id')
            ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id')
            ->where('cajas.id_empresa', $datos->empresa_id)
            ->when($this->caja, function ($query) {
                return $query->where('cajas.title_caja', $this->caja);
            })
            ->when($this->empleado, function ($query) {
                return $query->where('empleados.nombre_empleado', $this->empleado);
            })
            ->when($this->cliente, function ($query) {
                return $query->where('clientes.nombre_cliente', $this->cliente);
            })
            ->get();


        //dd($tablaVentas);
        return view('livewire.reportes.reporte-venta-personalizado', compact('datos', 'tablaVentas', 'cajas', 'empleados', 'clientes'));
    }
}
