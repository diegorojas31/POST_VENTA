<?php

namespace App\Livewire\Reportes\Caja;

use App\Models\Caja;
use App\Models\Empresa_cliente;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Ejecutivo extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        $cantidadCajasEmpresa1 = Caja::where('id_empresa', $datos->empresa_id)->count();

        $cantidadCajasHabilitadas = Caja::where('id_empresa', $datos->empresa_id)
            ->where('estado', 'habilitado')
            ->count();

        $sumaSaldoFinal = Caja::where('id_empresa', $datos->empresa_id)
            ->with('cajaventas')
            ->get()
            ->flatMap->cajaventas
            ->sum('saldo_final');


        $cajaConMayorSuma = Caja::where('id_empresa', $datos->empresa_id)
            ->with('cajaventas')
            ->get()
            ->map(function ($caja) {
                $caja->sumaTotal = $caja->cajaventas->sum('saldo_final');
                return $caja;
            })
            ->sortByDesc('sumaTotal')
            ->first()->title_caja;

        $sumaTotalCajaConMayorSuma = Caja::where('id_empresa', $datos->empresa_id)
            ->where('estado', 'habilitado')
            ->with('cajaventas')
            ->get()
            ->map(function ($caja) {
                $caja->sumaTotal = $caja->cajaventas->sum('saldo_final');
                return $caja;
            })
            ->sortByDesc('sumaTotal')
            ->first();

        $sumaTotal = 0;
        if ($sumaTotalCajaConMayorSuma) {
            $sumaTotal = $sumaTotalCajaConMayorSuma->sumaTotal;
        }
        return view('livewire.reportes.caja.ejecutivo', compact('datos', 'cantidadCajasEmpresa1','cantidadCajasHabilitadas', 'sumaSaldoFinal', 'cajaConMayorSuma', 'sumaTotalCajaConMayorSuma', 'sumaTotal'));
    }
}
