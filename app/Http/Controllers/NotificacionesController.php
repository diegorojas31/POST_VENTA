<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    //

    public function index()
    {

        $notificaciones = auth()->user()->notifications;
        return view('notificaciones', compact('notificaciones'));
    }
}
