<?php

namespace App\Http\Controllers\Reportes;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReporteStockController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('reportes.stock.stock-index');
    }

    public function reporteAnalitico()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('reportes.stock.stock-analitico');
    }

    public function reporteEjecutivo()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        $products = Producto::all();
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('reportes.stock.stock-ejecutivo', compact('products'));
    }
}
