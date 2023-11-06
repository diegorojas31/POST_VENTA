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
use Illuminate\Auth\Notifications\VerifyEmail;

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
        $roles = Role::select('*')->get();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('CRUD_USUARIO.create_users')->with('datos', $datos)->with('cargos', $cargos)->with('roles', $roles);
    }
    public function abrir_all_users()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        $empleados = User::join('empleados', 'empleados.usuario_id', '=', 'users.id')->join('cargos', 'cargos.id', '=', 'empleados.cargo_id')
            ->join('roles', 'roles.id', '=', 'users.rol_id')->where('users.empresa_id', $datos->empresa_id)->where('users.delete_user', 1)->select('users.id as id', 'users.name as name', 'users.email',  'users.rol_id', 'users.empresa_id',  'empleados.nombre_empleado', 'empleados.apellido_empleado', 'empleados.celular_empleado', 'empleados.usuario_id', 'empleados.cargo_id', 'cargos.nombre_cargo', 'cargos.descripcion_cargo', 'cargos.delete_cargo', 'roles.name as name_rol')->get();



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
            $usuario = User::where('id', $existingUser->id)->update([
                'delete_user' => 1,
                'name' => $request->nombre_empleado . ' ' . $request->apellido_empleado,
                'password' => bcrypt($request->password),
                'rol_id' => $request->rol_id,
                'empresa_id' => $request->id_bussines,
            ]);


            $empleados = Empleados::where('usuario_id', $existingUser->id)->update([
                'nombre_empleado' => $request->nombre_empleado,
                'apellido_empleado' => $request->apellido_empleado,
                'celular_empleado' => $request->celular_empleado,
                'delete_empleado' => 1,
                'cargo_id' => $request->cargo_id
            ]);

            //----------------------------------BITACORA--------------------------
            $userId = Auth::id();
            $user = User::find($userId);

            $ipUsuario = request()->ip();
            Activity()
                ->causedBy($user->id)
                ->inLog($user->name)
                ->performedOn($empleados)
                ->withProperties([
                    'nombre' => $usuario->name,
                    'correo' => $usuario->email,
                    'ip_pc' => $ipUsuario
                ])
                ->log('Se volvio a habilitar el usuario del Empleado : ' . $usuario->name);

            ///////////////////////////////////////////////////////////////////////

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
        //----------------------------------BITACORA--------------------------
        $userId = Auth::id();
        $userauth = User::find($userId);

        $ipUsuario = request()->ip();
        Activity()
            ->causedBy($userauth->id)
            ->inLog($userauth->name)
            ->performedOn($empleados)
            ->withProperties([
                'nombre' => $user->name,
                'correo' => $user->email,
                'ip_pc' => $ipUsuario
            ])
            ->log('Se creo un nuevo Usuario empleado : ' . $user->name);

        ///////////////////////////////////////////////////////////////////////

        $user->notify(new VerifyEmail($user));
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
            $userId = Auth::id();
            $user = User::find($userId);
            $ipUsuario = request()->ip();
            Activity()
                ->causedBy($userId)
                ->inLog($user->name)
                ->performedOn($user)
                ->withProperties([
                    'ip_request' => $ipUsuario
                ])
                ->log('Usuario: '.$user->name.', cambio su contraseña')
            ;

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
                $preEmpresa = Empresa_cliente::find($request->business_id);
                $Empresa = Empresa_cliente::where('id', $request->business_id)->update([
                    'razon_social' => $request->razon_social,
                    'nit_empresa' => $request->nit,
                    'nombre_titular' => $request->name,
                    'apellido_titular' => $request->lastname,
                    'celular_titular' => $request->celular,
                ]);
                $preUser = User::where('id', $user->id)->first();
                $usuario = User::where('id', $user->id)->update([
                    'name' => $request->name . ' ' . $request->lastname,
                    'email' => $request->email
                ]);

                //----------------------------------BITACORA--------------------------
                
                $ipUsuario = request()->ip();
                Activity()
                    ->causedBy($user->id)
                    ->inLog($user->name)
                    ->performedOn($usuario)
                    ->withProperties([
                        //EMPRESA
                        'preRazon_social' => $preEmpresa->razon_social,
                        'preNit_empresa' => $preEmpresa->nit,
                        'preNombre_titular' => $preEmpresa->name,
                        'preApellido_titular' => $preEmpresa->lastname,
                        'preCelular_titular' => $preEmpresa->celular,
                        //
                        'razon_social' => $Empresa->razon_social,
                        'nit_empresa' => $Empresa->nit,
                        'nombre_titular' => $Empresa->name,
                        'apellido_titular' => $Empresa->lastname,
                        'celular_titular' => $Empresa->celular,
                        //usuario
                        '´preName' => $preUser->name,
                        'preEmail' => $preUser->email,
                        //
                        'name' => $usuario->name,
                        'email' => $usuario->email,

                        'ip_request' => $ipUsuario
                    ])
                    ->log('La cuenta empresarial de  : ' . $Empresa->razon_social . 'edito su perfil y modifico su correo')
                ;
    
                ///////////////////////////////////////////////////////////////////////
                return redirect()->route('abrir_edit_users');
            }
            $preEmpresa = Empresa_cliente::where('id', $request->business_id)->first();
            $Empresa =  Empresa_cliente::where('id', $request->business_id)->update([
                'razon_social' => $request->razon_social,
                'nit_empresa' => $request->nit,
                'nombre_titular' => $request->name,
                'apellido_titular' => $request->lastname,
                'celular_titular' => $request->celular,
            ]);
            $preUser = User::where('id', $user->id)->first();
            $usuario = User::where('id', $user->id)->update([
                'name' => $request->name . ' ' . $request->lastname,
            ]);
                        //----------------------------------BITACORA--------------------------
                
                        $ipUsuario = request()->ip();
                        Activity()
                            ->causedBy($user->id)
                            ->inLog($user->name)
                            ->performedOn($usuario)
                            ->withProperties([
                                //EMPRESA
                                'preRazon_social' => $preEmpresa->razon_social,
                                'preNit_empresa' => $preEmpresa->nit,
                                'preNombre_titular' => $preEmpresa->name,
                                'preApellido_titular' => $preEmpresa->lastname,
                                'preCelular_titular' => $preEmpresa->celular,
                                //
                                'razon_social' => $Empresa->razon_social,
                                'nit_empresa' => $Empresa->nit,
                                'nombre_titular' => $Empresa->name,
                                'apellido_titular' => $Empresa->lastname,
                                'celular_titular' => $Empresa->celular,
                                //usuario
                                '´preName' => $preUser->name,
                                'preEmail' => $preUser->email,
                                //
                                'name' => $usuario->name,
                                'email' => $usuario->email,
        
                                'ip_request' => $ipUsuario
                            ])
                            ->log('La cuenta empresarial de  : ' . $Empresa->razon_social . 'edito su perfil sin modificar su correo')
                        ;
            
                        ///////////////////////////////////////////////////////////////////////
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
            $preEmpleado = Empleados::where('usuario_id', $user->id)->first();
            $empleados = Empleados::where('usuario_id', $user->id)->update([
                'nombre_empleado' => $request->name,
                'apellido_empleado' => $request->lastname,

            ]);
            $preUser = User::find($user->id);
            $usuario =  User::where('id', $user->id)->update([
                'name' => $request->name . ' ' . $request->lastname,
                'email' => $request->email
            ]);
             //------------------------BITACORA---------------------------
             $ipUsuario = request()->ip();
             Activity()
             ->causedBy($user->id)
             ->inLog($user->name)
             ->performedOn($empleados)
             ->withProperties([
                 //EMPLEADOS
                 'preNombre_empleado' => $preEmpleado->name,
                 'preApellido_empleado' => $preEmpleado->lastname,
                 //
                 'nombre_empleado' => $empleados->name,
                 'apellido_empleado' => $empleados->lastname,
                 //USERS
                 'preName_user' => $preUser->name,
                 'preEmail_user' => $preUser->email,
                 //
                 'name_user' => $usuario->name,
                 'email_user' => $usuario->email,
                 'ip_pc'=>$ipUsuario
             ])
             ->log('Se edito el perfil' . $usuario->name . 'y cambio su correo')
         ;
         ///////////////////////////////////////////////////////////
            return redirect()->route('abrir_edit_users');
        }
        $preEmpleado = Empleados::where('usuario_id', $user->id)->first();
       $empleados = Empleados::where('usuario_id', $user->id)->update([
            'nombre_empleado' => $request->name,
            'apellido_empleado' => $request->lastname,

        ]);
        $preUser = User::where('id', $user->id)->first();
        $usuario = User::where('id', $user->id)->update([
            'name' => $request->name . ' ' . $request->lastname,

        ]);
          //------------------------BITACORA---------------------------
          $ipUsuario = request()->ip();
          Activity()
          ->causedBy($user->id)
          ->inLog($user->name)
          ->performedOn($empleados)
          ->withProperties([
              //EMPLEADOS
              'preNombre_empleado' => $preEmpleado->name,
              'preApellido_empleado' => $preEmpleado->lastname,
              //
              'nombre_empleado' => $empleados->name,
              'apellido_empleado' => $empleados->lastname,
              //USERS
              'preName_user' => $preUser->name,
              'preEmail_user' => $preUser->email,
              //
              'name_user' => $usuario->name,
              'email_user' => $usuario->email,
              'ip_pc'=>$ipUsuario
          ])
          ->log('Se edito el perfil' . $usuario->name . 'sin cambiar su correo')
      ;
      ///////////////////////////////////////////////////////////
        return redirect()->route('abrir_edit_users');
    }

    public function user_delete($id)
    {

        User::where('id', $id)->update([
            'delete_user' => 0
        ]);
        $empleados = Empleados::where('usuario_id', $id)->update([
            'delete_empleado' => 0
        ]);
         //-------------------------------BIRACORA -----------------------------+
         $userId = Auth::user()->id;
         $user = User::find($userId);
         $user1 = User::find($id);
         $empleados = Empleados::find($empleados);   
         $ipUsuario = request()->ip();
         Activity()
             ->causedBy($user->id)
             ->inLog($user->name)
             ->performedOn($empleados)
             ->withProperties([
                 'name' => $user1->name,
                 'email' => $user1->email,
                 'ip_pc' => $ipUsuario
             ])
             ->log('Usuario: '.$user1->name.', ELIMINADO')
         ;
         ///////////////////////////////////////////////////////////////////////
        return redirect()->route('abrir_all_users');
    }
    public function update_rol($id, $nuevo_rol)
    {
        $user = User::find($id);
        $preUser = $user;
        User::where('id', $id)->update([
            'rol_id' => $nuevo_rol
        ]);
        $rol = $nuevo_rol;
        $user->roles()->detach();
        $user->syncRoles($rol);

                //----------------------------------BITACORA -----------------------------------
                $userId = Auth::user()->id;
                $user = User::find($userId);
        
                $ipUsuario = request()->ip();
                Activity()
                    ->causedBy($user->id)
                    ->inLog($user->name)
                    ->performedOn($user)
                    ->withProperties([
                        'preRol' => $preUser->rol_id,
                        'rol' => $user->rol_id,
                        'ip_pc' => $ipUsuario
                    ])
                    ->log('rol "'.$preUser->rol_id.'" cambiado a rol "'.$user->rol_id.'"');
                ;
                //////////////////////////////////////////////////////////////////////////////
        return redirect()->route('abrir_all_users');
    }
}
