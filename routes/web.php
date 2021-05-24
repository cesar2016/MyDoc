<?php

use App\Models\Specialty;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// # Rutas Asociadas al CRUD de Specialty 
Route::get('/specialties','App\Http\Controllers\SpecialtyController@index');
Route::get('/specialties/create', 'App\Http\Controllers\SpecialtyController@create'); //Form Registro
Route::get('/specialties/{specialty}/edit', 'App\Http\Controllers\SpecialtyController@edit');

Route::post('/specialties/create', 'App\Http\Controllers\SpecialtyController@store'); //Envio del registro
Route::put('/specialties/{specialty}', 'App\Http\Controllers\SpecialtyController@update');
Route::delete('/specialties/{specialty}/delete', 'App\Http\Controllers\SpecialtyController@destroy');

// # Rutas Asociadas al CRUD de Specialty 
Route::resource('doctors','App\Http\Controllers\DoctorController');



