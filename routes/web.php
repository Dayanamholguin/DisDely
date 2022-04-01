<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

//Sabor
use App\Http\Controllers\SaborController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Sabor
Route::get('/sabor', [SaborController::class, 'index']);
Route::get('/sabor/listar', [SaborController::class, 'listar']);
Route::get('/sabor/crear', [SaborController::class, 'create']);
Route::post('/sabor/guardar', [SaborController::class, 'save']);
Route::get('/sabor/editar/{id}', [SaborController::class, 'edit']);
Route::post('/sabor/actualizar', [SaborController::class, 'update']);
Route::get('/sabor/cambiar/estado/{id}/{estado}', [SaborController::class, 'updateState']);
