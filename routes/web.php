<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('vehiculos', App\Http\Controllers\VehiculosControlador::class . '@index');
Route::post('vehiculos', App\Http\Controllers\VehiculosControlador::class . '@store');
Route::put('vehiculos/{id}', App\Http\Controllers\VehiculosControlador::class . '@update');
Route::post('/vehiculos/eliminar', App\Http\Controllers\VehiculosControlador::class . '@destroy');
