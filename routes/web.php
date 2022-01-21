<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablecimientoController;

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

Route::get('/establecimiento', function () {
    return view('establecimiento.index');
});

//Route::get('/establecimiento/create', [EstablecimientoController::class,'create']);

Route::resource('establecimiento', EstablecimientoController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EstablecimientoController::class, 'index'])->name('home');

Route::group(['middleware'=> 'auth'], function(){
    Route::get('/home', [EstablecimientoController::class, 'index'])->name('home');
});