<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function buscarPorNit($nit)

    {
        //return response()->json($nit);
        $cliente = Cliente::where('nit_cliente', $nit)
                           ->where('delete_cliente', 1)
                           ->first(); 
    
        if ($cliente) {
            return response()->json($cliente); // Retorna el resultado como JSON
        } else {
            return response()->json(['error' => 'Cliente no encontrado']); // Retorna un mensaje de error si el cliente no se encuentra
        }
    }
    
}
