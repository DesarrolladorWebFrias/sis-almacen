<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categorias;
use App\Http\Controllers\Clientes;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Detalleventas;
use App\Http\Controllers\Productos;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Ventas;
use Illuminate\Support\Facades\Route;


//CREAR UN USUARIO UNA VEZ 
Route::get('/crear-admin', [AuthController::class, 'CrearAdmin']);




//HACER LA RUTA VALIDA 

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
//RUTA PARA CERRAR SESION
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware("auth")->group(function(){
    Route::get('/home', [Dashboard::class, 'index'])->name('home'); //SE CAMBIA EL CONTROLADOR
    
    });





//se crea la ruta para ventas y detalles ventas
route::prefix('ventas')->group(function(){
   route::get('/nueva-venta', [Ventas::class, 'index'])->name('ventas-nueva');
    });

route::prefix('detalle')->group(function(){
    route::get('/detalle-venta', [Detalleventas::class, 'index'])->name('detalle-venta');
    });

route::prefix('categorias')->group(function(){
    route::get('/', [Categorias::class, 'index'])->name('categorias');

});    

route::prefix('productos')->group(function(){
    route::get('/', [Productos::class, 'index'])->name('productos');

});    

route::prefix('clientes')->group(function(){
    route::get('/', [Clientes::class, 'index'])->name('clientes');

});  

route::prefix('usuarios')->group(function(){
    route::get('/', [Usuarios::class, 'index'])->name('usuarios');

});  

