<?php

namespace App\Livewire\Reportes\Inventario;

use Livewire\Component;
use App\Models\Empresa_cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Analitico extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $empresaCliente = Empresa_cliente::find($datos->empresa_id);

        $productos = $empresaCliente->productos;

        $productosConPocoStock = $empresaCliente->productos()->whereHas('stock', function ($query) {
            $query->where('cantidad', '<=', 10);
        })->get();

        $productosConMuchoStock = $empresaCliente->productos()->whereHas('stock', function ($query) {
            $query->where('cantidad', '>=', 50);
        })->get();




        return view('livewire.reportes.inventario.analitico', compact('datos', 'productos', 'productosConPocoStock', 'productosConMuchoStock'));
    }
}
