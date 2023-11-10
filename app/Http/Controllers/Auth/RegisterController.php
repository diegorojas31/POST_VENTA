<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Cargos;
use App\Models\Empresa_cliente;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FuncionController;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'razon_social' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'celular' => ['required', 'numeric'],
            'nit' => ['required', 'numeric'],
        ], [
            'name.required' => 'El nombre titular es requerido.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'email.unique' => 'El correo ya está en uso.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'razon_social.required' => 'La razón social es requerida.',
            'lastname.required' => 'El apellido titular es requerido.',
            'celular.required' => 'El campo celular es requerido.',
            'celular.numeric' => 'El campo celular debe ser un número.',
            'nit.required' => 'El campo NIT es requerido.',
            'nit.numeric' => 'El campo NIT debe ser un número.',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $empresa = Empresa_cliente::create([
            'razon_social' => $data['razon_social'],
            'nit_empresa' => $data['nit'],
            'nombre_titular' => $data['name'],
            'apellido_titular' => $data['lastname'],
            'celular_titular' => $data['celular']
        ]);

        

        $permissions = Permission::all();
        $rol= Role::create(['name'=>'Master','id_empresa'=>$empresa->id]);
        $rol->syncPermissions($permissions);
        $user = User::create([
            'name' => $data['name'] . ' ' . $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol_id' => 1,
            'empresa_id' => $empresa->id
        ])->syncRoles($rol->id);

        $user->createAsStripeCustomer();

        $ipUsuario = request()->ip();
        // Obtener la información del Activity Log
        $activity= Activity()
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn(Empresa_cliente::find($user->id))
            ->withProperties([
                'razon_social' => $data['razon_social'],
                'nit_empresa' => $data['nit'],
                'celular_titular' => $data['celular'],
                'ip_usuario' => $ipUsuario
            ])
            ->log('Cuenta Master Creada');

            $idMaster = $empresa->id;
            $CSV = new FuncionController;
            $CSV->nuevoArchivoCSV($idMaster);
            $CSV->guardarEnCSV($activity, $idMaster);

        $user->notify(new VerifyEmail($user));
        return $user;
    }
}
