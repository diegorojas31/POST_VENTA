<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cargos;
use App\Models\Empleados;
use Illuminate\Http\Request;
use App\Models\Empresa_cliente;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function abrir_crear_users()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();
        $cargos = Cargos::select('*')->get();
        $roles= Role::select('*')->get();
        

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('CRUD_USUARIO.create_users')->with('datos', $datos)->with('cargos', $cargos)->with('roles',$roles);
    }
    public function abrir_all_users()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        $empleados = User::join('empleados', 'empleados.usuario_id', '=', 'users.id')->join('cargos', 'cargos.id', '=', 'empleados.cargo_id')
        ->join('roles','roles.id','=','users.rol_id')->where('users.empresa_id', $datos->empresa_id)->where('users.delete_user', 1)->select('users.id as id', 'users.name as name', 'users.email',  'users.rol_id', 'users.empresa_id',  'empleados.nombre_empleado', 'empleados.apellido_empleado', 'empleados.celular_empleado', 'empleados.usuario_id', 'empleados.cargo_id', 'cargos.nombre_cargo', 'cargos.descripcion_cargo', 'cargos.delete_cargo','roles.name as name_rol')->get();
        
        
        
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('CRUD_USUARIO.read_users')->with('datos', $datos)->with('empleados', $empleados);
    }
    public function abrir_edit_users()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        if ($datos->rol_id == 1) {
            $datos_empresa = Empresa_cliente::where('empresa_clientes.id', $datos->empresa_id)->select('*')->first();
            config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
            return view('CRUD_USUARIO.edit_users')->with('datos', $datos)->with('datos_empresa', $datos_empresa);
        }

        $datos_empleado = Empleados::where('empleados.usuario_id', $userId)->select('*')->first();
        //dd($datos_empleado,$datos);
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('CRUD_USUARIO.edit_users')->with('datos', $datos)->with('datos_empleado', $datos_empleado);
    }
    public function crear_empleado_users(Request $request)
    {
        $this->validate($request, [
            'nombre_empleado' => 'required|filled',
            'apellido_empleado' => 'required|filled',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'celular_empleado' => 'required|filled',
            'cargo_id' => 'required|numeric|not_in:0',
            'rol_id' => 'required|numeric|not_in:0',
        ], [
            'nombre_empleado.required' => 'Nombre requerido.',
            'apellido_empleado.required' => 'Apellido es requerido.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'EL CORREO debe ser un email valido.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.min' => 'La contraseña debe tener al menos 6:min caracteres.',
            'celular_empleado.required' => 'El campo celular es requerido.',
            'cargo_id.not_in' => 'Seleccione un cargo.',
            'rol_id.not_in' => 'Seleccione un Rol.',

        ]);
    
        $existingUser = User::where('email', $request->email)->where('delete_user', 0)->first();

        if ($existingUser) {
            $roles = $request->rol_id;
            $existingUser->roles()->detach();
            $existingUser->syncRoles($roles);
            User::where('id', $existingUser->id)->update([
                'delete_user' => 1,
                'name' => $request->nombre_empleado . ' ' . $request->apellido_empleado,
                'password' => bcrypt($request->password),
                'rol_id'=>$request->rol_id,
            ]);
            

            Empleados::where('usuario_id', $existingUser->id)->update([
                'nombre_empleado' => $request->nombre_empleado,
                'apellido_empleado' => $request->apellido_empleado,
                'celular_empleado' => $request->celular_empleado,
                'delete_empleado' => 1,
                'cargo_id' => $request->cargo_id
            ]);
            return redirect()->route('abrir_crear_users');
        }
        $this->validate($request, [

            'email' => 'unique:users',
        ], [
            'email.unique' => 'El correo ya está en uso.',
        ]);
        $user = User::create([
            'name' => $request->nombre_empleado . ' ' . $request->apellido_empleado,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Recuerda encriptar la contraseña
            'rol_id' => $request->rol_id, // Aquí puedes hacerlo dinámico para que elija un rol
            'empresa_id' => $request->id_bussines
        ]);
        $roles = $request->rol_id;
        $user->syncRoles($roles);


        $empleados = Empleados::create([
            'nombre_empleado' => $request->nombre_empleado,
            'apellido_empleado' => $request->apellido_empleado,
            'celular_empleado' => $request->celular_empleado,
            'usuario_id' => $user->id,
            'cargo_id' => $request->cargo_id
        ]);
        return redirect()->route('abrir_crear_users');
    }
    public function cambiar_contraseña(Request $request)
    {
        $this->validate($request, [
            'antigua_contraseña' => 'required|filled',
            'nueva_contraseña' => 'required|filled', // La nueva contraseña debe tener al menos 8 caracteres
        ], [
            'antigua_contraseña.required' => 'Escriba su anterior contraseña requerido.',
            'nueva_contraseña.required' => 'Escriba su nueva contraseña.',
        ]);

        $user = Auth::user(); // Obtiene al usuario autenticado

        // Verifica si la contraseña antigua proporcionada coincide con la contraseña actual del usuario
        if (Hash::check($request->antigua_contraseña, $user->password)) {
            // La contraseña antigua coincide, puedes proceder a actualizarla

            User::where('id', $user->id)->update(['password' => Hash::make($request->nueva_contraseña)]);

            return response()->json(['mensaje' => 'Contraseña actualizada correctamente.']);
        } else {
            return response()->json(['error' => 'La contraseña antigua no es correcta.'], 422);
        }
    }
    public function update_perfil(Request $request)
    {

        //-----ENTONCES LA CUENTA ES EMPRESARIAL----------//
        if ($request->rol_id == 1) {
            $this->validate($request, [
                'razon_social' => 'required|filled',
                'nit' => 'required|numeric',
                'email' => 'required|email',
                'name' => 'required|filled',
                'lastname' => 'required|filled',
                'celular' => 'required|numeric',

            ], [
                'razon_social.required' => 'La Razón Social es requerida.',
                'nit.required' => 'El NIT es requerido.',
                'nit.numeric' => 'El NIT debe ser un número.',
                'email.required' => 'El correo es requerido.',
                'email.email' => 'El correo debe ser una dirección de correo válida.',
                'name.required' => 'El nombre es requerido.',
                'lastname.required' => 'El apellido es requerido.',
                'celular.required' => 'El celular es requerido.',
                'celular.numeric' => 'El celular debe ser un número.',

            ]);

            $user = Auth::user();
            if ($user->email !== $request->email) {
                $this->validate($request, [

                    'email' => 'unique:users',
                ], [
                    'email.unique' => 'El correo ya está en uso.',
                ]);
                Empresa_cliente::where('id', $request->business_id)->update([
                    'razon_social' => $request->razon_social,
                    'nit_empresa' => $request->nit,
                    'nombre_titular' => $request->name,
                    'apellido_titular' => $request->lastname,
                    'celular_titular' => $request->celular,
                ]);

                User::where('id', $user->id)->update([
                    'name' => $request->name . ' ' . $request->lastname,
                    'email' => $request->email
                ]);
                return redirect()->route('abrir_edit_users');
            }

            Empresa_cliente::where('id', $request->business_id)->update([
                'razon_social' => $request->razon_social,
                'nit_empresa' => $request->nit,
                'nombre_titular' => $request->name,
                'apellido_titular' => $request->lastname,
                'celular_titular' => $request->celular,
            ]);
            User::where('id', $user->id)->update([
                'name' => $request->name . ' ' . $request->lastname,
            ]);
            return redirect()->route('abrir_edit_users');
        }
        //-----ENTONCES ES UNA CUENTA EMPLEADO------------//
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|filled',
            'lastname' => 'required|filled',
        ], [
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'name.required' => 'El nombre es requerido.',
            'lastname.required' => 'El apellido es requerido.',

        ]);
        
        $user = Auth::user();
        
        if ($user->email !== $request->email) {
            $this->validate($request, [

                'email' => 'unique:users',
            ], [
                'email.unique' => 'El correo ya está en uso.',
            ]);

            Empleados::where('usuario_id', $user->id)->update([
                'nombre_empleado' => $request->name,
                'apellido_empleado' => $request->lastname,
    
            ]);
            User::where('id', $user->id)->update([
                'name' => $request->name . ' ' . $request->lastname,
                'email' => $request->email
            ]);
            return redirect()->route('abrir_edit_users');
        }
        Empleados::where('usuario_id', $user->id)->update([
            'nombre_empleado' => $request->name,
            'apellido_empleado' => $request->lastname,

        ]);

        User::where('id', $user->id)->update([
            'name' => $request->name . ' ' . $request->lastname,
            
        ]);
        return redirect()->route('abrir_edit_users');
    }

    public function user_delete($id)
    {

        User::where('id', $id)->update([
            'delete_user' => 0
        ]);
        Empleados::where('usuario_id', $id)->update([
            'delete_empleado' => 0
        ]);
        return redirect()->route('abrir_all_users');
    }
    public function update_rol($id,$nuevo_rol){
      $user=User::find($id);
      User::where('id', $id)->update([
        'rol_id' => $nuevo_rol
    ]);
    $rol = $nuevo_rol;
    $user->roles()->detach();
    $user->syncRoles($rol);
      return redirect()->route('abrir_all_users');
    }
}
