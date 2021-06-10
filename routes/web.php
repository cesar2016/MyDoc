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


// # Rutas agrupadas para el ADMIN 
Route::middleware(['auth', 'admin'])->group(function () { 

//************ MIS PROPIOS SEEDERS ********************** */
Route::get('/doctors/seed', 'App\Http\Controllers\Admin\DoctorController@storeSeed'); //Asocia especialidades al MEDICO

//****************************************************** */

// # Rutas Asociadas al CRUD de Specialty 
Route::get('/specialties','App\Http\Controllers\Admin\SpecialtyController@index');
Route::get('/specialties/create', 'App\Http\Controllers\Admin\SpecialtyController@create'); //Form Registro
Route::get('/specialties/{specialty}/edit', 'App\Http\Controllers\Admin\SpecialtyController@edit');

Route::post('/specialties/create', 'App\Http\Controllers\Admin\SpecialtyController@store'); //Envio del registro
Route::put('/specialties/{specialty}', 'App\Http\Controllers\Admin\SpecialtyController@update');
Route::delete('/specialties/{specialty}/delete', 'App\Http\Controllers\Admin\SpecialtyController@destroy');

// # Rutas Asociadas al CRUD de Doctor 
Route::resource('doctors','App\Http\Controllers\Admin\DoctorController');

// # Rutas Asociadas al CRUD de Patients 
Route::resource('patients','App\Http\Controllers\Admin\PatientController');




});

// # Rutas agrupadas para el DORCTOR
Route::middleware(['auth', 'doctor'])->group(function () {
    // # Rutas Asociadas al CRUD de Specialty 
    Route::get('/schedule', 'App\Http\Controllers\Doctor\ScheduleController@edit');
    Route::post('/schedule', 'App\Http\Controllers\Doctor\ScheduleController@store');    
 
});

Route::middleware('auth')->group(function () {
    // # Rutas agrupadas para el PACIENTES
Route::get('/appointments/create', 'App\Http\Controllers\AppointmentController@create');
Route::post('/appointments', 'App\Http\Controllers\AppointmentController@store');

// Route JSON
Route::get('/specialties/{specialty}/doctors', 'App\Http\Controllers\Api\SpecialtyController@doctors');
Route::get('/schedule/hours', 'App\Http\Controllers\Api\ScheduleController@hours');

    
});







