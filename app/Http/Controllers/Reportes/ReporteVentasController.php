<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteVentasController extends Controller
{
    //
    public function index()
    {
        //
        return view('reportes.venta.ventas-index');
    }

    public function reporteAnalitico()
    {
        //

        return view('reportes.venta.venta-analitico');
    }

    public function reporteEjecutivo()
    {
        //

        return view('reportes.venta.venta-ejecutivo');
    }
}
