<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
        $this->middleware('auth');   
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validacion = Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nombre' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255', 'unique:App\Models\user,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['exists:Spatie\Permission\Models\Role,id']
        ],[
            'min'   =>  'El tamaño de la contraseña debe ser mayor a 7 caracteres.',
            'required'   =>  'Campo requerido.',
            'unique'  => 'Usuario existente, favor de elegir otro usuario.',
            'string'  => 'El campo debe ser una cadena.',
            'exists'  => 'Rol inválido.',
        ]);

        // return "hola";

        return $validacion;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return "Hola";
        $usuario_creado = User::create([
            'name' => $data['nombre'],
            'email' => $data['usuario'],
            'password' => Hash::make($data['password']),
        ]);

        $usuario_creado->assignRole($data['rol']);

        return $usuario_creado;
    }
}
