<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //FUNCION PARA REDIRECCIONAR AL LOGIN
   public function index (){
    // DECLARCION VARIABLE DE REDIRECCION AL LOGIN
    $titulo = "Login de Usuarios";
    return view("modules.auth.login", compact("titulo"));
   }
   //PROGRAMAR LOGUEAR

   public function logear(Request $request){
    //VALIDAR LOS DATOD R LAS CREDENCIALES 
    $credenciales = $request->validate([
        "email" => "required|email",
        "password" => "required"

    ]);
    //VAKIDAR QUE NO ALLA EMAIL REPETIDOS 

    $user = User::where('email', $request->email)->first();//BUSCAR EMAIL REGRESA VERDADERO O FALSO
    //REALIZAMOS LA CONDICION 
    //VALIDAR USUARIO Y CONTRASEÑA
    if( !$user || !Hash::check($request->password, $user->password)){
        return back()->withErrors(['email' => 'Credencial Incorrecta'])->withInput();

    }
    //SI EL USUARIO ESTA ACTIVO
    if(!$user->activo){
        return back()->withErrors(['email' => 'Tu Cuenta No esta Activa'])->withInput();

    }
    //CREAR SESION USUARIO
    Auth::login($user);
    $request->session()->regenerate();
    //REDIRECCIONAR A LA PAGINA PRINCIPAL
    return to_route('home');
   
   }

   public function crearAdmin(){
    //creaar directamente un admin
    User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('admin'),
        'activo' => true,
        'rol' => 'admin'
    ]);
    return "Admin Creado Exitosamente";

   }
   //CERRAR SESION
public function logout(){
    Auth::logout();
    return to_route('login');
}

}
