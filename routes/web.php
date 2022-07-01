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
//Pedido 
use App\Http\Controllers\PedidoController;
//carrito 
use App\Http\Controllers\CartController;
//Abono 
use App\Http\Controllers\abonoController;
//Dashboard 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrincipalController;

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', [MenuController::class, 'welcome']);
Route::group(['middleware' => 'auth'], function(){
    //inicio
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Dashboard
    Route::get('/dashobard', [DashboardController::class, 'index']);
    //Rol
    Route::get('/rol', [RoleController::class, 'index'])->middleware('can:/rol');
    Route::get('/rol/listar', [RoleController::class, 'listar'])->middleware('can:rol/listar');
    Route::get('/rol/crear', [RoleController::class, 'crear'])->middleware('can:rol/crear');
    Route::post('/rol/guardar', [RoleController::class, 'guardar'])->middleware('can:rol/crear');
    Route::get('/rol/editar/{id}', [RoleController::class, 'editar'])->middleware('can:rol/editar');
    Route::post('/rol/actualizar', [RoleController::class, 'modificar'])->middleware(('can:rol/editar'));
    Route::get('/rol/ver/{id}', [RoleController::class, 'ver'])->middleware('can:rol/ver');
    Route::get('/rol/cambiar/estado/{id}/{estado}', [RoleController::class, 'modificarEstado'])->middleware('can:rol/cambiar/estado');

    //Sabor
    Route::get('/sabor', [SaborController::class, 'index'])->middleware('can:/sabor');
    Route::get('/sabor/listar', [SaborController::class, 'listar'])->middleware('can:sabor/listar');
    Route::get('/sabor/crear', [SaborController::class, 'crear'])->middleware('can:sabor/crear');
    Route::post('/sabor/guardar', [SaborController::class, 'guardar'])->middleware('can:sabor/crear');
    Route::get('/sabor/editar/{id}', [SaborController::class, 'editar'])->middleware('can:sabor/editar');
    Route::post('/sabor/actualizar', [SaborController::class, 'modificar'])->middleware('can:sabor/editar');
    Route::get('/sabor/cambiar/estado/{id}/{estado}', [SaborController::class, 'modificarEstado'])->middleware('can:sabor/cambiar/estado');

    //categorias
    Route::get('/categoria', [CategoriaController::class, 'index'])->middleware('can:/categoria');
    Route::get('/categoria/listar', [CategoriaController::class, 'listar'])->middleware('can:categoria/listar');
    Route::get('/categoria/crear', [CategoriaController::class, 'crear'])->middleware('can:categoria/crear');
    Route::post('/categoria/guardar', [CategoriaController::class, 'guardar'])->middleware('can:categoria/crear');
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar'])->middleware('can:categoria/editar');
    Route::post('/categoria/actualizar', [CategoriaController::class, 'modificar'])->middleware('can:categoria/editar');
    Route::get('/categoria/cambiar/estado/{id}/{estado}', [CategoriaController::class, 'modificarEstado'])->middleware('can:categoria/cambiar/estado');

    //productos
    Route::get('/producto', [ProductoController::class, 'index'])->middleware('can:/producto');
    Route::get('/producto/listar', [ProductoController::class, 'listar'])->middleware('can:producto/listar');
    Route::get('/producto/crear', [ProductoController::class, 'crear'])->middleware('can:producto/crear');
    Route::post('/producto/guardar', [ProductoController::class, 'guardar'])->middleware('can:producto/crear');
    Route::get('/producto/editar/{id}', [ProductoController::class, 'editar'])->middleware('can:producto/editar');
    Route::get('/producto/ver/{id}', [ProductoController::class, 'ver'])->middleware('can:producto/ver');
    Route::get('/producto/verProductoAjax/{id}', [ProductoController::class, 'verProductoAjax'])->middleware('can:producto/verProductoCatalogo');
    Route::get('/producto/verProductoCatalogo/{id}', [ProductoController::class, 'verProductoCatalogo'])->middleware('can:producto/verProductoCatalogo');
    Route::get('/producto/catalogo', [ProductoController::class, 'catalogo'])->middleware('can:producto/verProductoCatalogo');
    // Route::get('/producto/catalogoJson', [ProductoController::class, 'catalogoJson']);
    Route::post('/producto/actualizar', [ProductoController::class, 'modificar'])->middleware('can:producto/editar');
    Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'modificarEstado'])->middleware('can:producto/cambiar/estado');

    //usuarios
    Route::get('/usuario', [UsuarioController::class, 'index'])->middleware('can:/usuario');
    Route::get('/usuario/listar', [UsuarioController::class, 'listar'])->middleware('can:usuario/listar');
    Route::get('/usuario/crear', [UsuarioController::class, 'crear'])->middleware('can:usuario/crear');
    Route::post('/usuario/guardar', [UsuarioController::class, 'guardar'])->middleware('can:usuario/crear');
    Route::get('/usuario/editar/{id}', [UsuarioController::class, 'editar'])->middleware('can:usuario/editar');
    Route::get('/usuario/ver/{id}', [UsuarioController::class, 'ver'])->middleware('can:usuario/ver');
    Route::post('/usuario/actualizar/{id}', [UsuarioController::class, 'modificar'])->middleware('can:usuario/editar');
    Route::get('/usuario/cambiar/estado/{id}/{estado}', [UsuarioController::class, 'modificarEstado'])->middleware('can:usuario/cambiar/estado');

    //perfil
    Route::get('/perfil/{id}', [PerfilController::class, 'index']);
    Route::post('/perfil/actualizar/{id}', [PerfilController::class, 'modificar']); //->middleware('passwords.confirm');
    Route::get('/perfil/cambiar/{id}', [PerfilController::class, 'cambiar']);
    Route::post('/perfil/cambiarContrasena/{id}', [PerfilController::class, 'cambiarContrasena']);
    Route::get('/perfil/cambiarFoto/{id}', [PerfilController::class, 'cambiarFoto']);
    Route::post('/perfil/recibirFoto/{id}', [PerfilController::class, 'recibirFoto']);

    //carrito
    Route::get('/carrito', [CartController::class, 'carrito'])->middleware('can:agregarCarrito');
    Route::post('/agregarCarrito', [CartController::class, 'agregarCarrito'])->middleware('can:agregarCarrito');
    Route::post('/actualizarCarrito', [CartController::class, 'actualizarCarrito'])->middleware('can:actualizarCarrito');
    Route::post('/quitarProducto', [CartController::class, 'quitarProducto'])->middleware('can:agregarCarrito');
    Route::post('/limpiarCarrito', [CartController::class, 'limpiarCarrito'])->middleware('can:agregarCarrito');
    Route::get('/ver/carritoCotizacion/{id}', [CartController::class, 'ver'])->middleware('can:agregarCarrito');
    Route::get('/ver/imagen/{id}', [CartController::class, 'verImagen']);

    //cotización
    Route::get('/cotizacion', [CotizacionController::class, 'index'])->middleware('can:/cotizacion');
    Route::post('/quitarProducto', [CotizacionController::class, 'quitarProducto'])->middleware('can:cotizacion/editar');
    Route::post('/actualizarCarrito', [CotizacionController::class, 'actualizarCarrito'])->middleware('can:cotizacion/editar');
    Route::get('/ver/carrito/{id}', [CotizacionController::class, 'ver'])->middleware('can:cotizacion/editar');
    Route::get('/cotizacion/listar', [CotizacionController::class, 'listar'])->middleware('can:cotizacion/listar');
    Route::get('/cotizacion/crear/{producto}', [CotizacionController::class, 'crear'])->middleware('can:cotizacion/crear', 'can:agregarCarrito');
    Route::get('/cotizacion/personalizada', [CotizacionController::class, 'Personalizada'])->middleware('can:cotizacion/personalizada', 'can:agregarCarrito');
    Route::post('/cotizacion/guardar', [CotizacionController::class, 'guardar'])->middleware('can:cotizacion/crear');
    Route::get('/cotizacion/editar/{id}', [CotizacionController::class, 'editar'])->middleware('can:cotizacion/editar');
    Route::get('/cancelar', [CotizacionController::class, 'cancelar'])->middleware('can:cotizacion/cancelar');
    Route::get('/cotizacion/ver/{id}', [CotizacionController::class, 'verDetalle'])->middleware('can:cotizacion/ver');
    // Route::get('/cotizacion/verListado/{id}', [CotizacionController::class, 'verListar']);
    Route::post('/cotizacion/actualizar', [CotizacionController::class, 'modificar'])->middleware('can:cotizacion/editar');
    
    //pedido
    Route::get('/pedido', [PedidoController::class, 'index'])->middleware('can:/pedido');
    Route::get('/pedido/listar', [PedidoController::class, 'listar'])->middleware('can:pedido/listar');
    Route::get('/pedido/buscarUsuarios', [PedidoController::class, 'buscarUsuarios'])->middleware('can:pedido/crear');
    Route::get('/pedido/requisitos', [PedidoController::class, 'requisitos'])->middleware('can:pedido/crear');
    Route::post('/pedido/crear', [PedidoController::class, 'crear'])->middleware('can:pedido/crear');
    Route::get('/ver/carritoP/{id}', [PedidoController::class, 'ver'])->middleware('can:pedido/crear');
    Route::get('/carritoPedido/{id}', [PedidoController::class, 'carrito'])->middleware('can:carritoPedido');
    Route::post('/pedido/guardar', [PedidoController::class, 'guardar'])->middleware('can:pedido/crear');
    Route::get('/pedido/ver/{id}', [PedidoController::class, 'verDetalle'])->middleware('can:pedido/ver');
    Route::get('/pedido/editar/{id}', [PedidoController::class, 'editar'])->middleware('can:pedido/editar');
    Route::get('/cancelarP', [PedidoController::class, 'cancelarP'])->middleware('can:pedido/editar');
    Route::post('/pedido/actualizar', [PedidoController::class, 'modificar'])->middleware('can:pedido/editar');
    Route::get('/ver/imagenPedido/{imagen}', [PedidoController::class, 'verImagen']);
    Route::post('/limpiarCarritoPedido', [PedidoController::class, 'limpiarCarritoPedido'])->middleware('can:limpiarCarritoPedido');
    Route::post('/quitarProductoPedido', [PedidoController::class, 'quitar'])->middleware('can:quitarProductoPedido');
    Route::post('/actualizarPreProductos', [PedidoController::class, 'actualizarPreProductos'])->middleware('can:actualizarPreProductos');
    Route::post('/actualizarProductosPedido', [PedidoController::class, 'actualizarProductosPedido'])->middleware('can:actualizarProductosPedido');
    Route::post('/agregarCarritoPedido', [PedidoController::class, 'agregarCarritoPedido'])->middleware('can:agregarCarritoPedido');
    Route::get('/pedido/crear/{producto}/{cliente}', [PedidoController::class, 'crearProductoRegistrado'])->middleware('can:pedido/crear/producto/cliente');

    // abonos
    Route::get('/abono', [abonoController::class, 'index'])->middleware('can:/abono');
    Route::get('/abono/verAbonoPedido/{id}', [abonoController::class, 'verAbonoPedido'])->middleware('can:abono/ver');
    Route::get('/abono/listar', [abonoController::class, 'listar'])->middleware('can:abono/listar');
    Route::get('/abono/crear/{id}', [abonoController::class, 'crear'])->middleware('can:abono/crear');
    Route::get('/abono/ver/{id}', [abonoController::class, 'ver'])->middleware('can:abono/ver');
    Route::get('/abono/verIndividual/{id}', [abonoController::class, 'verIndividual'])->middleware('can:abono/verIndividual');
    Route::get('/ver/imagenAbono/{imagen}', [abonoController::class, 'verImagen']);
    Route::post('/abono/guardar', [abonoController::class, 'guardar'])->middleware('can:abono/crear');
    
    // principal - configruacion
    Route::get('/configuracion/editar', [PrincipalController::class, 'editar'])->middleware('can:configuracion/editar'); //->middleware('password.confirm');
    Route::post('/configuracion/actualizar', [PrincipalController::class, 'modificar'])->middleware('can:configuracion/editar'); //->middleware('password.confirm');
    Route::get('/configuracion/restablecer', [PrincipalController::class, 'restablecer'])->middleware('can:configuracion/editar'); //->middleware('password.confirm');
    //para mostrar
    /*Route::get('/imagenes/{path}/{attachment}', function($path, $attachment){
        $file = sprintf('storage/%s/%s', $path, $attachment);
        if(File::exists($file)){
            return \Intervention\Image\Facades\Image::mak($file)->response();
        }
    });*/

});
