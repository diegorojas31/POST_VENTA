<?php

namespace App\Livewire\Reportes\Caja;

use App\Models\Caja;
use App\Models\Cajaventa;
use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Empresa_cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Analitico extends Component
{
    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = Carbon::now()->format('Y-m-d');
        $this->to_date = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $cajas = Caja::where('id_empresa', $datos->empresa_id)->get();

        $resultados = DB::table('cajaventas')
            ->join('cajas', 'cajaventas.id_caja', '=', 'cajas.id')
            ->join('empleados', 'cajaventas.id_usuario', '=', 'empleados.usuario_id')
            ->select(
            'cajas.title_caja as NombreCaja', 
            'empleados.nombre_empleado as NombreUsuario', 
            'cajaventas.saldo_inicial', 
            'cajaventas.saldo_final', 
            'cajaventas.fecha_apertura', 
            'cajaventas.fecha_cierre')
            ->where('cajas.id_empresa', $datos->empresa_id)
            ->get();

       // dd($resultados);

        return view('livewire.reportes.caja.analitico', compact('datos', 'cajas'));
    }
}
