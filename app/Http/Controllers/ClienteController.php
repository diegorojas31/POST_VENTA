<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{

public function index(){
    $userId = Auth::id();

    $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
        ->where('users.id', $userId)
        ->select('*')->first();


    $clientes= Cliente::where('clientes.delete_cliente',1)->where('clientes.empresa_id',$datos->empresa_id)->select('*')->get();
    
    
    
    config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
    return view('clientes.read_clientes')->with('datos', $datos)->with('clientes', $clientes);
}

public function abrir_create_clientes(){
    $userId = Auth::id();

    $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
        ->where('users.id', $userId)
        ->select('*')->first();
    $cargos = Cargos::select('*')->get();
    $roles= Role::select('*')->get();
    

    config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
    return view('clientes.create_clientes')->with('datos', $datos)->with('cargos', $cargos)->with('roles',$roles);

}

    public function buscarPorNit($nit)

    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        $cliente = Cliente::where('nit_cliente', $nit)
                           ->where('empresa_id',$datos->empresa_id)
                           ->where('delete_cliente', 1)
                           ->first(); 
    
        if ($cliente) {
            return response()->json($cliente); // Retorna el resultado como JSON
        } else {
            return response()->json(['error' => 'Cliente no encontrado']); // Retorna un mensaje de error si el cliente no se encuentra
        }
    }
    public function destroy($id){
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete_cliente = 0; // Cambia el campo delete_cliente a 0 (eliminado)
            $cliente->save();
            
            return redirect()->route('clientes.index')->with('success', 'Cliente marcado como eliminado');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Error al marcar como eliminado al cliente');
        }
    }

    public function crear_cliente(Request $request)
    {
       
        $this->validate($request, [
            'nombre_cliente' => 'required|filled',
            'apellido_cliente' => 'required|filled',
            'celular_cliente' => 'required|filled',
            'nit_cliente' => [
                'required',
                'filled',
                Rule::unique('clientes', 'nit_cliente')->where(function ($query) use ($request) {
                    return $query->where('empresa_id', $request->input('id_bussines'));
                }),
            ],
            ], [
            'nombre_cliente.required' => 'Nombre requerido.',
            'apellido_cliente.required' => 'Apellido es requerido.',
            'celular_cliente.required' => 'El campo celular es requerido.',
            'nit_cliente.required' => 'El nit es requerido.',
            'nit_cliente.unique' => 'Este NIT ya está registrado para esta empresa.',
        
        ]);
     
        $cliente = Cliente::create([
            'nombre_cliente' => $request->input('nombre_cliente'),
            'apellido_cliente' => $request->input('apellido_cliente'),
            'celular_cliente' => $request->input('celular_cliente'),
            'nit_cliente' => $request->input('nit_cliente'),
            'empresa_id'=>$request->input('id_bussines'),
        ]);

   
        return redirect()->route('clientes.index');
    }
    
}
