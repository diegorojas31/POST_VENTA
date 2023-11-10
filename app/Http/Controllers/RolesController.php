<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Permission as ModelsPermission;

class RolesController extends Controller
{

    public function all_roles(){
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        
        
        $roles = Role::where('roles.id_empresa',$datos->empresa_id)->select('*')->get();
        


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('roles.allroles')->with('datos', $datos)->with('roles', $roles);
    }

    public function abrir_crear_roles()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        $roles = Role::where('roles.id_empresa',$datos->empresa_id)->select('*')->get();

        $permisos = ModelsPermission::select('*')->get();
        //dd($permisos);


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('roles.create_roles')->with('datos', $datos)->with('roles', $roles);
    }

    public function crear_roles(Request $request)
    {

        $request->validate([
            'nombre_rol' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $existeRol = DB::table('roles')
                        ->where('name', $value)
                        ->where('id_empresa', $request->input('id_bussines'))
                        ->exists();
                    if ($existeRol) {
                        $fail('Ya existe un rol con ese nombre para esta empresa.');
                    } {
                    }
                }
            ]
        ], [
            'nombre_rol.required' => 'El nombre del rol es obligatorio.',
            'nombre_rol.unique' => 'Ya existe un rol con ese nombre para esta empresa.'
        ]);

        //dd($request);
        $userId = Auth::id();
        $rol = Role::create(['name' => $request->input('nombre_rol'), 'id_empresa' => $request->input('id_bussines')]);

        // Obtén los permisos marcados (2, 3, 4, 5)
        $permisosMarcados = $request->only(['2', '3', '4', '5']);

        // Itera sobre los permisos marcados y asígnales al rol
        foreach ($permisosMarcados as $permiso => $valor) {
            if ($valor === 'on') {
                // Busca el permiso por su ID y asígnalo al rol
                $permisoModel = Permission::find($permiso);
    
                if ($permisoModel) {
                    $rol->permissions()->attach($permisoModel->id);
                }
            }
        }

                //---------------------------------------BITACORA---------------------------

                $user = User::find($userId);
                $ipUsuario = request()->ip();
                $activity=Activity()
                    ->causedBy($user->id)
                    ->inLog($user->name)
                    ->performedOn($rol)
                    ->withProperties([
                        'nombre_rol' => $rol->name,
        
                        'ip_pc' => $ipUsuario
                    ])
                    ->log('Se creo el rol: ' . $rol->name);
        
                    $idMaster = $rol->id_empresa;
                    $CSV = new FuncionController;
                    
                    $CSV->guardarEnCSV($activity, $idMaster);
                /////////////////////////////////////////////////////////////////////////////

        return redirect()->route('all_roles');
    }
}
