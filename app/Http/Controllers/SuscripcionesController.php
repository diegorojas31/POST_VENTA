<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission as ModelsPermission;

class SuscripcionesController extends Controller
{
    public function abrir_suscripciones(){
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        
        $roles = Role::select('*')->get();

        $permisos= ModelsPermission::select('*')->get();

       /* $intent =  Auth::user()->createSetupIntent();
        $paymentMethods =  Auth::user()->paymentMethods();*/
        //dd($intent,$paymentMethods);


        


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('suscripciones.suscripciones')->with('datos', $datos)->with('roles', $roles);
    }

    public function añadir_metodo_pago($paymentMethod){

        auth()->user()->addPaymentMethod($paymentMethod);
          
     /*   if (!auth()->user()->hasDefaultPaymentMethod()) {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }*/

    }
}
