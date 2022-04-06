<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\SecretariasController;
use App\Http\Controllers\HomeController;

//Ruta para seleccionar como se desea ingresar al sistema
Route::get('/', function () {
    return view('modulos.Seleccionar');
});
//ruta para generar formulario de ingresar
Route::get('/Ingresar', function () {
    return view('modulos.Ingresar');
});

Route::get('/resgistro', function () {
    return view('auth.register');
});

Route::get('/recuperar-password', function () { //Ruta para la view de recuperar contraseña.
    return view('modulos.email');
 });


Route::get('/home', [HomeController::class,'index']);




Auth::routes(['verify' => true]);

Route::get('Inicio', [InicioController::class,'index']);
Route::get('Mis-Datos',[InicioController::class,'DatosCreate']);
//Editar mis datos anda fallando
Route::put('Mis-Datos',[InicioController::class,'DatosUpdate']);
//
Route::get('Inicio-Editar',[InicioController::class,'edit']);
Route::put('Inicio-Editar',[InicioController::class,'update']);


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
Route::put('actualizar-paciente/{paciente}',[PacientesController::class,'update']);
Route::get('Eliminar-Paciente/{id}', [PacientesController::class,'destroy']);
//Modulo Doctor
Route::get('Citas/{id}',[CitasController::class,'index']);
Route::post('Horario',[CitasController::class,'HorarioDoctor']);
Route::put('editar-horario/{id}',[CitasController::class,'EditarHoarario']);
Route::post('Citas/{id_doctor}',[CitasController::class,'CrearCita']);
Route::delete('borrar-cita',[CitasController::class,'destroy']);

// Modulo Pacientes
Route::get('Ver-Consultorios',[ConsultoriosController::class,'verConsultorios']);
Route::get('Ver-Doctores/{id}',[ConsultoriosController::class,'VerDoctores']);
    //historial
Route::get('Historial',[CitasController::class,'historial']);

//administrador
Route::get('Secretarias',[SecretariasController::class,'index']);
Route::post('Secretarias',[SecretariasController::class,'store']);
Route::get('Eliminar-Secretaria/{id}',[SecretariasController::class,'destroy']);
Route::get('Editar-Secretaria/{id}', [SecretariasController::class,'show']);
Route::put('actualizar-secretaria/{id}',[SecretariasController::class,'update']);
