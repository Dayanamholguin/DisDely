<?php
use Illuminate\Support\Facades\Route;
use App\Http;
use App\Http\Controllers\HomeController;
//Rol
use App\Http\Controllers\RoleController;
//Sabor
use App\Http\Controllers\SaborController;
//categoria
use App\Http\Controllers\CategoriaController;
//Producto
use App\Http\Controllers\ProductoController;
//usuarios
use App\Http\Controllers\UsuarioController;
//perfil
use App\Http\Controllers\PerfilController;
//Menu 
use App\Http\Controllers\MenuController;
//cotización 
use App\Http\Controllers\CotizacionController;
//carrito 
use App\Http\Controllers\CartController;
// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [MenuController::class, 'welcome']);

Route::group(['middleware' => 'auth'], function(){

    //Rol
    Route::get('/rol', [RoleController::class, 'index']);
    Route::get('/rol/listar', [RoleController::class, 'listar']);
    Route::get('/rol/crear', [RoleController::class, 'crear']);
    Route::post('/rol/guardar', [RoleController::class, 'guardar']);
    Route::get('/rol/editar/{id}', [RoleController::class, 'editar']);
    Route::post('/rol/actualizar', [RoleController::class, 'modificar']);
    Route::get('/rol/ver/{id}', [RoleController::class, 'ver']);
    Route::get('/rol/cambiar/estado/{id}/{estado}', [RoleController::class, 'modificarEstado']);

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
    Route::get('/producto/verProductoCatalogo/{id}', [ProductoController::class, 'verProductoCatalogo']);
    Route::get('/producto/catalogo', [ProductoController::class, 'catalogo']);
    Route::post('/producto/actualizar', [ProductoController::class, 'modificar']);
    Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'modificarEstado']);

    //usuarios
    Route::get('/usuario', [UsuarioController::class, 'index']); //->middleware('auth', 'can:usuarios');
    Route::get('/usuario/listar', [UsuarioController::class, 'listar']);
    Route::get('/usuario/crear', [UsuarioController::class, 'crear']);
    Route::post('/usuario/guardar', [UsuarioController::class, 'guardar']);
    Route::get('/usuario/editar/{id}', [UsuarioController::class, 'editar']);
    Route::get('/usuario/ver/{id}', [UsuarioController::class, 'ver']);
    Route::post('/usuario/actualizar/{id}', [UsuarioController::class, 'modificar']);
    Route::get('/usuario/cambiar/estado/{id}/{estado}', [UsuarioController::class, 'modificarEstado']);

    //perfil
    Route::get('/perfil/{id}', [PerfilController::class, 'index']);
    Route::post('/perfil/actualizar/{id}', [PerfilController::class, 'modificar']); //->middleware('passwords.confirm');
    Route::get('/perfil/cambiar/{id}', [PerfilController::class, 'cambiar']);
    Route::post('/perfil/cambiarContrasena/{id}', [PerfilController::class, 'cambiarContrasena']);
    Route::get('/perfil/cambiarFoto/{id}', [PerfilController::class, 'cambiarFoto']);
    Route::post('/perfil/recibirFoto/{id}', [PerfilController::class, 'recibirFoto']);

    //carrito
    Route::get('/carrito', [CartController::class, 'carrito']);
    Route::post('/agregarCarrito', [CartController::class, 'agregarCarrito']);
    Route::post('/actualizarCarrito', [CartController::class, 'actualizarCarrito']);
    Route::post('/quitarProducto', [CartController::class, 'quitarProducto']);
    Route::post('/limpiarCarrito', [CartController::class, 'limpiarCarrito']);
    Route::get('/ver/carrito/{id}', [CartController::class, 'ver']);
    Route::get('/ver/imagen/{id}', [CartController::class, 'verImagen']);

    //cotización
    Route::get('/cotizacion', [CotizacionController::class, 'index']);
    Route::get('/cotizacion/listar', [CotizacionController::class, 'listar']);
    Route::get('/cotizacion/crear/{producto}', [CotizacionController::class, 'crear']);
    Route::get('/cotizacion/personalizada', [CotizacionController::class, 'Personalizada']);
    Route::post('/cotizacion/guardar', [CotizacionController::class, 'guardar']);
    Route::get('/cotizacion/editar/{id}', [CotizacionController::class, 'editar']);
    Route::get('/cancelar', [CotizacionController::class, 'cancelar']);
    Route::get('/cotizacion/ver/{id}', [CotizacionController::class, 'verDetalle']);
    Route::get('/cotizacion/verListado/{id}', [CotizacionController::class, 'verListar']);
    Route::post('/cotizacion/actualizar', [CotizacionController::class, 'modificar']);

    // Route::post('/perfil/actualizar/{id}', [PerfilController::class, 'modificar'])->middleware('password.confirm');
    //para mostrar
    /*Route::get('/imagenes/{path}/{attachment}', function($path, $attachment){
        $file = sprintf('storage/%s/%s', $path, $attachment);
        if(File::exists($file)){
            return \Intervention\Image\Facades\Image::mak($file)->response();
        }
    });*/

});
