<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\PacientesController;


Route::get('/', function () {
    return view('modulos.Seleccionar');
});

Route::get('/Ingresar', function () {
    return view('modulos.Ingresar');
});

Auth::routes();

Route::get('Inicio', [InicioController::class,'index']);

Route::get('Consultorios', [ConsultoriosController::class,'index']);

Route::post('Consultorios', [ConsultoriosController::class,'store']);

Route::put('Consultorio/{id}', [ConsultoriosController::class,'update']);

Route::delete('borrar-Consultorio/{id}', [ConsultoriosController::class,'destroy']);


Route::get('Doctores', [DoctoresController::class,'index']);
Route::post('Doctores', [DoctoresController::class,'store']);
Route::get('Eliminar-Doctor/{id}', [DoctoresController::class,'destroy']);

Route::get('Pacientes',[PacientesController::class,'index']);
Route::get('Crear-Paciente',[PacientesController::class,'create']);
Route::post('Crear-Paciente',[PacientesController::class,'store']);
Route::get('Editar-Paciente/{id}',[PacientesController::class,'edit']);
