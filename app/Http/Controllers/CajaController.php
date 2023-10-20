<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    public function index(){
        

            
            
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        //dd($datos);
        $cajas = Caja::where('delete_caja', 1)->where('id_empresa',$datos->empresa_id)->get();
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.index',compact('cajas'));
        //return view('caja.index');
    }
    public function create(){
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.create');

    }
    public function store(Request $request){
        //return $request->all();
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('empresa_clientes.id as id_empresa')->first();

        $caja = new Caja();
        $caja->title_caja=$request->nombrecaja;
        $caja->estado="inhabilitado";
        $caja->id_empresa=$datos->id_empresa;
        $caja->save();
        return redirect()->route('caja.show',$caja->id);

    }
    public function show($id){
        $cajas = Caja::find($id);
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);

        return view('caja.show',compact('cajas'));
    }
    public function edit(Caja $caja){
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.edit',compact('caja'));
    }
    public function update(Request $request,Caja $caja){
        $caja->title_caja=$request->nombrecaja;
        $caja->estado=$request->estado;
        $caja->save();
        $userId = Auth::id();
        
        $datos = User::join('empresa_clientes','empresa_clientes.id','=','users.empresa_id')
        ->where('users.id',$userId)
        ->select('*')->first();
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('caja.confirmado');
        
    }
    public function destroy($id){


        
        Caja::where('id', $id)->where('estado','inhabilitado')->update([
            'delete_caja' => 0,
        ]);
 
        return redirect()->route('caja.index');
        // DB::beginTransaction();
        // try {
        //     $caja->delete();
        //     DB::commit();
 
        //     return view('caja.eliminado');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return "error";
        // }
    }
}
