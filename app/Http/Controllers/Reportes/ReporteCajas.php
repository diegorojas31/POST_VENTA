<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteCajas extends Controller
{
    //
    public function index()
    {
        return view("reportes.caja.caja");
    }

    public function reporteAnalitico()
    {
        return view("reportes.caja.analitico");
    }

    public function reporteEjecutivo()
    {
        return view("reportes.caja.ejecutivo");
    }

}
