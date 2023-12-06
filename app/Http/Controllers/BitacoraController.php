<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

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


        $roles = Role::where('roles.id', $user->rol_id)->select('*')->first();

        if ($roles->name == 'Master') {
            $bitacora = Activity::whereHas('causer', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();
            //-------------------------------LOGO ADMINLTE----------------
            $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
                ->where('users.id', $userId)
                ->select('*')->first();
            config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
            //-------------------------------------------------------------
            //dd($datos);
            return view('bitacora.encryptacion_bitacora')->with('datos', $datos)->with('bitacora', $bitacora);
        }
    }

    public function descargarBitacora()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $id_empresa = $user->empresa_id;
        $archivo = "master_" . $id_empresa . ".csv";
        $rutaArchivo = storage_path("Bitacora\{$archivo}");

        return response()->download($rutaArchivo, $archivo, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment',
        ]);
    }

    public function  desencryptar_bitacora(Request $request)
    {
        //dd($request);
        $request->validate([
            'password' => 'required', // Ajusta las reglas según tus necesidades
        ],[
         'password.required'=>'La contraseña es requerida'   
        ]);
        $user = auth()->user();
                // Verificar la contraseña
                if (Hash::check($request->password, $user->password)) {
                    // La contraseña es válida, haz algo aquí
                    // ...
        
                    return redirect()->route('mostrar_bitacora');
                } else {
                    // La contraseña no es válida
                    return redirect()->route('Bitacora.index')->with('error', 'Contraseña incorrecta');
                }
    }

    public function mostrar_bitacora(){
        $bitacora = '';
        $userId = Auth::id();
        $user = User::find($userId);


        $roles = Role::where('roles.id', $user->rol_id)->select('*')->first();

        if ($roles->name == 'Master') {
            $bitacora = Activity::whereHas('causer', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();
            //-------------------------------LOGO ADMINLTE----------------
            $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
                ->where('users.id', $userId)
                ->select('*')->first();
            config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
            //-------------------------------------------------------------
            //dd($datos);
            return view('bitacora.bitacoraView')->with('datos', $datos)->with('bitacora', $bitacora);
        }
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
