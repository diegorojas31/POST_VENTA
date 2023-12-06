<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteInventario extends Controller
{
    //
    public function index(){
        return view("reportes.inventario.inventario");
    }

    public function reporteAnalitico(){
        return view("reportes.inventario.analitico");
    }

    public function reporteEjecutivo()
    {
        return view("reportes.inventario.ejecutivo");
    }

    public function reportePersonalizado(){
        return view("reportes.inventario.personalizado");
    }
}
