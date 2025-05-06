<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //FUNCION PARA REDIRECCIONAR AL LOGIN
   public function index (){
    return view("modules.auth.login");
   }
}
