<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bitacora = '';
        $userId = Auth::id();
        $user = User::find($userId);

        if($user->rol_id == 1){
            $bitacora = Activity::whereHas('causer', function($query) use($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();
        }



        //-------------------------------LOGO ADMINLTE----------------
        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
        ->where('users.id', $userId)
        ->select('*')->first();
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        //-------------------------------------------------------------
        return $bitacora;
        return view('bitacora.bitacoraView',compact('bitacora'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
