<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin', 'estado' => '1']);
        $cliente = Role::create(['name' => 'Cliente', 'estado' => '1']);
    
        //---------------------------------ROLES--------------------------------------------------
        Permission::create(['name' => '/rol', 'description' => 'Roles módulo'])->syncRoles($admin);

        Permission::create(['name' => 'rol/listar',
                'description' => 'Roles ver listado'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/crear',
                'description' => 'Rol crear'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/editar',
                'description' => 'Rol editar'])->syncRoles($admin);
                            
        // Permission::create(['name' => 'rol/ver',
        //         'description' => 'Rol ver información'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/cambiar/estado',
                'description' => 'Rol cambiar estado'])->syncRoles($admin);

        //------------------------------------SABORES-----------------------------------------------
        Permission::create(['name' => '/sabor', 'description' => 'Sabores módulo'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/listar',
                'description' => 'Sabores ver listado'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/crear', 
                'description' => 'Sabor crear'])->syncRoles($admin);
                            
        Permission::create(['name' => 'sabor/editar', 
                'description' => 'Sabor editar'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/cambiar/estado', 
                'description' => 'Sabor cambiar estado'])->syncRoles($admin);

        //-------------------------------------CATEGORIA----------------------------------------------
        Permission::create(['name' => '/categoria', 'description' => 'Categorías módulo'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/listar', 
                'description' => 'Categorías ver listado'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/crear', 
                'description' => 'Categoría crear'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/editar', 
                'description' => 'Categoría editar'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/cambiar/estado', 
                'description' => 'Categoría cambiar estado'])->syncRoles($admin);

        //----------------------------------------PRODUCTO-------------------------------------------
        Permission::create(['name' => '/producto', 'description' => 'Productos módulo'])->syncRoles($admin, $cliente);
        
        Permission::create(['name' => 'producto/listar', 
                'description' => 'Producto ver listado'])->syncRoles($admin);

        Permission::create(['name' => 'producto/crear', 
                'description' => 'Producto crear'])->syncRoles($admin);

        Permission::create(['name' => 'producto/editar', 
                'description' => 'Producto editar'])->syncRoles($admin);

        Permission::create(['name' => 'producto/ver', 
                'description' => 'Producto ver información'])->syncRoles($admin);

        Permission::create(['name' => 'producto/verProductoCatalogo', 
                'description' => 'Ver productos del catálogo'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'producto/cambiar/estado', 
                'description' => 'Producto cambiar estado'])->syncRoles($admin);

        //--------------------------------------USUARIO---------------------------------------------
        Permission::create(['name' => '/usuario', 'description' => 'Usuarios módulo'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/listar',
                'description' => 'Usuarios ver listado'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/crear',
                'description' => 'Usuario crear'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/editar',
                'description' => 'Usuario editar'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/ver',
                'description' => 'Usuario ver información'])->syncRoles($admin);        
            
        Permission::create(['name' => 'usuario/cambiar/estado',
                'description' => 'Usuario cambiar estado'])->syncRoles($admin);
                 
        //-------------------------------------CARRITO----------------------------------------------
        Permission::create(['name' => 'agregarCarrito',
                'description' => 'Carrito para hacer cotización'])->syncRoles($cliente, $admin);
                
        Permission::create(['name' => 'actualizarCarrito', 
                'description' => 'Carrito actualizar cotización'])->syncRoles($cliente);

        Permission::create(['name' => 'quitarProducto',
                'description' => 'Carrito quitar productos'])->syncRoles($cliente);

        Permission::create(['name' => 'limpiarCarrito',
                'description' => 'Carrito limpiar'])->syncRoles($cliente, $admin);

        Permission::create(['name' => 'ver/carrito',
                'description' => 'Carrito ver información'])->syncRoles($cliente);

        Permission::create(['name' => '/venta',
                'description' => 'Ventas módulo'])->syncRoles($admin, $cliente);
                        
        //-------------------------------------COTIZACION----------------------------------------------
        Permission::create(['name' => '/cotizacion', 'description' => 'Cotizaciones módulo'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'cotizacion/listar',
                'description' => 'Cotizaciones ver listado'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'cotizacion/crear',
                'description' => 'Cotización crear'])->syncRoles($cliente, $admin);
               
        Permission::create(['name' => 'cotizacion/personalizada',
                'description' => 'Cotización crear personalizada'])->syncRoles($cliente, $admin);

        Permission::create(['name' => 'cotizacion/editar',
                'description' => 'Cotización editar'])->syncRoles($admin);
                
        Permission::create(['name' => 'cotizacion/cancelar',
                'description' => 'Cotización cancelar'])->syncRoles($admin);

        Permission::create(['name' => 'cotizacion/ver',
                'description' => 'Cotización ver información'])->syncRoles($admin, $cliente);  
             
        //-------------------------------------PEDIDOS----------------------------------------------
        Permission::create(['name' => '/pedido', 'description' => 'Pedidos módulo'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'pedido/listar',
                'description' => 'Pedidos ver listado'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'pedido/crear',
                'description' => 'Pedido crear'])->syncRoles($admin); 
        
        Permission::create(['name' => 'carritoPedido',
                'description' => 'Carrito para hacer pedido'])->syncRoles($admin); 
                
        Permission::create(['name' => 'pedido/ver',
                'description' => 'Pedido ver información'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'pedido/editar',
                'description' => 'Pedido editar'])->syncRoles($admin); 
                
        Permission::create(['name' => 'limpiarCarritoPedido',
                'description' => 'Pedido limpiar carrito'])->syncRoles($admin); 
                
        Permission::create(['name' => 'quitarProductoPedido',
                'description' => 'Pedido quitar producto'])->syncRoles($admin); 
        
        Permission::create(['name' => 'actualizarPreProductos',
                'description' => 'Pedido actualizar productos antes de hacer'])->syncRoles($cliente, $admin); 

        Permission::create(['name' => 'actualizarProductosPedido',
                'description' => 'Pedido actualizar productos'])->syncRoles($admin); 

        Permission::create(['name' => 'agregarCarritoPedido',
                'description' => 'Pedido agregar productos de carrito'])->syncRoles($cliente, $admin); 
                
        Permission::create(['name' => 'pedido/crear/producto/cliente',
                'description' => 'Pedido crear con producto registrado'])->syncRoles($cliente, $admin); 
                
        //-------------------------------------ABONOS---------------------------------------------
        Permission::create(['name' => '/abono', 'description' => 'Abonos módulo'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'abono/listar',
                'description' => 'Abonos ver listado'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'abono/crear',
                'description' => 'Abono crear'])->syncRoles($admin); 

        Permission::create(['name' => 'abono/ver',
                'description' => 'Abonos ver información'])->syncRoles($admin, $cliente); 
                
        Permission::create(['name' => 'abono/verIndividual',
                'description' => 'Abono ver individual'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'abono/cambiarEstado',
                'description' => 'Anular abono'])->syncRoles($admin);

        Permission::create(['name' => 'configuracion/editar',
                'description' => 'Editar configuración principal'])->syncRoles($admin);

        
        }
}
