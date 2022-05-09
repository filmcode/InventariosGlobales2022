<?php

use Illuminate\Support\Facades\Route;

//agregamos los controladores

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarroController; 
use App\Http\Controllers\GraficaController; 
use App\Http\Controllers\ObservacionesController; 

use App\Mail\NotificationCars;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('carros', CarroController::class);
    Route::resource('grafica', GraficaController::class);
    Route::post('/ajaxGrafica', [GraficaController::class, 'ajaxGrafica']);
    Route::post('/ajaxEstado', [CarroController::class, 'ajaxEstado']);
    Route::get('/observaciones/{id}', [ObservacionesController::class, 'index']);
    Route::post('/observaciones/{id_api}', [ObservacionesController::class, 'create']);
    Route::post('/observaciones/edit/{id_api}', [ObservacionesController::class, 'update']);
    Route::get('/notification', function () {
        $correo = new NotificationCars;

        Mail::to('welkrondiaz@gmail.com')->send($correo);
        return "mensaje enviado";
    });   
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
