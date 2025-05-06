<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //se crea el controlador que sacara la vista 

    public function index(){ 
        return view("modules.dashboard.home");

    }
    
}
