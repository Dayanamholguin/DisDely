<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//Sabor
use App\Http\Controllers\SaborController;
//categoria
use App\Http\Controllers\CategoriaController;
//Producto
use App\Http\Controllers\ProductoController;

//Menu Galeria
use App\Http\Controllers\GaleriaController;

//Menu QuienesSomos
use App\Http\Controllers\QuienesController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Galeria
Route::get('/galeria', [GaleriaController::class, 'index'])->name('index');

//QuienesSomos
Route::get('/quienes', [QuienesController::class, 'index'])->name('index');

//Sabor
Route::get('/sabor', [SaborController::class, 'index']);
Route::get('/sabor/listar', [SaborController::class, 'listar']);
Route::get('/sabor/crear', [SaborController::class, 'crear']);
Route::post('/sabor/guardar', [SaborController::class, 'guardar']);
Route::get('/sabor/editar/{id}', [SaborController::class, 'editar']);
Route::post('/sabor/actualizar', [SaborController::class, 'modificar']);
Route::get('/sabor/cambiar/estado/{id}/{estado}', [SaborController::class, 'modificarEstado']);

//categorias
Route::get('/categoria', [CategoriaController::class, 'index']);
Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
Route::get('/categoria/crear', [CategoriaController::class, 'crear']);
Route::post('/categoria/guardar', [CategoriaController::class, 'guardar']);
Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar']);
Route::post('/categoria/actualizar', [CategoriaController::class, 'modificar']);
Route::get('/categoria/cambiar/estado/{id}/{estado}', [CategoriaController::class, 'modificarEstado']);

//productos
Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/listar', [ProductoController::class, 'listar']);
Route::get('/producto/crear', [ProductoController::class, 'crear']);
Route::post('/producto/guardar', [ProductoController::class, 'guardar']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'editar']);
Route::get('/producto/ver/{id}', [ProductoController::class, 'ver']);
Route::post('/producto/actualizar', [ProductoController::class, 'modificar']);
Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'modificarEstado']);