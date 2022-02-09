<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;


Route::get('/', function () {
    return view('modulos.Seleccionar');
});

Route::get('/Ingresar', function () {
    return view('modulos.Ingresar');
});

Auth::routes();

Route::get('Inicio', [InicioController::class,'index']);
