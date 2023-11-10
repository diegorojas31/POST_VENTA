<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ReporteStockController extends Controller
{
    //
    public function index()
    {
        return view('reportes.stock.stock-index');
    }

    public function reporteAnalitico()
    {
        //
        return view('reportes.stock.stock-analitico');
    }

    public function reporteEjecutivo()
    {
        //
        $products = Producto::all();
        return view('reportes.stock.stock-ejecutivo', compact('products'));
    }
}
