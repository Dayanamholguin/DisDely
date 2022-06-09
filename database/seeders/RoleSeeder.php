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
        Permission::create(['name' => 'rol/listar',
                'description' => 'Ver listado de roles'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/crear',
                'description' => 'Crear rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/editar',
                'description' => 'Editar rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/ver',
                'description' => 'Ver información del rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/cambiar/estado',
                'description' => 'Cambiar estado de rol'])->syncRoles($admin);

        //------------------------------------SABORES-----------------------------------------------
        Permission::create(['name' => 'sabor/listar',
                'description' => 'Ver listado de sabores'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/crear', 
                'description' => 'Crear sabor'])->syncRoles($admin);
                            
        Permission::create(['name' => 'sabor/editar', 
                'description' => 'Editar sabor'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/cambiar/estado', 
                'description' => 'Cambiar estado de sabor'])->syncRoles($admin);

        //-------------------------------------CATEGORIA----------------------------------------------
        Permission::create(['name' => 'categoria/listar', 
                'description' => 'Ver listado de categorías'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/crear', 
                'description' => 'Crear categoría'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/editar', 
                'description' => 'Editar categoría'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/cambiar/estado', 
                'description' => 'Cambiar estado de categoría'])->syncRoles($admin);

        //----------------------------------------PRODUCTO-------------------------------------------
        Permission::create(['name' => 'producto', 
                'description' => 'Productos'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'producto/listar', 
                'description' => 'Ver listado de producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/crear', 
                'description' => 'Crear producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/editar', 
                'description' => 'Editar Producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/ver', 
                'description' => 'Ver información del producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/verProductoCatalogo', 
                'description' => 'Ver productos del catálogo'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'producto/cambiar/estado', 
                'description' => 'Cambiar estado producto'])->syncRoles($admin);

        //--------------------------------------USUARIO---------------------------------------------
        Permission::create(['name' => 'usuario/listar',
                'description' => 'Ver listado de usuarios'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/crear',
                'description' => 'Crear usuario'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/editar',
                'description' => 'Editar usuario'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/ver',
                'description' => 'Ver información del usuario'])->syncRoles($admin);        
            
        Permission::create(['name' => 'usuario/cambiar/estado',
                'description' => 'Cambiar estado de usuario'])->syncRoles($admin);
                 
        //-------------------------------------CARRITO----------------------------------------------
        Permission::create(['name' => 'agregarCarrito',
                'description' => 'Carrito para hacer cotización'])->syncRoles($cliente);
                
        Permission::create(['name' => 'actualizarCarrito', 
                'description' => 'Actualizar cotización de carrito'])->syncRoles($cliente);

        Permission::create(['name' => 'quitarProducto',
                'description' => 'Quitar producto de carrito'])->syncRoles($cliente);

        Permission::create(['name' => 'limpiarCarrito',
                'description' => 'Limpiar carrito'])->syncRoles($cliente);

        Permission::create(['name' => 'ver/carrito',
                'description' => 'Ver información de carrito'])->syncRoles($cliente);

        Permission::create(['name' => 'venta',
                'description' => 'Ventas'])->syncRoles($admin, $cliente);
                        
        //-------------------------------------COTIZACION----------------------------------------------
        Permission::create(['name' => 'cotizacion/listar',
                'description' => 'Ver listado de cotizaciones'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'cotizacion/crear',
                'description' => 'Crear cotización'])->syncRoles($cliente);
               
        Permission::create(['name' => 'cotizacion/personalizada',
                'description' => 'Crear cotización personalizada'])->syncRoles($cliente);

        Permission::create(['name' => 'cotizacion/editar',
                'description' => 'Editar cotización'])->syncRoles($admin);

        Permission::create(['name' => 'cotizacion/ver',
                'description' => 'Ver información de cotización'])->syncRoles($admin, $cliente);  
             
        //-------------------------------------PEDIDOS----------------------------------------------
        Permission::create(['name' => 'pedido/listar',
                'description' => 'Ver listado de pedidos'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'pedido/crear',
                'description' => 'Crear pedido'])->syncRoles($admin); 
        
        Permission::create(['name' => 'carritoPedido',
                'description' => 'Carrito para hacer pedido'])->syncRoles($cliente); 
                
        Permission::create(['name' => 'pedido/ver',
                'description' => 'Ver información de pedido'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'pedido/editar',
                'description' => 'Editar pedido'])->syncRoles($admin); 
                
        Permission::create(['name' => 'cancelarP',
                'description' => 'Cancelar pedido'])->syncRoles($admin); 
                
        Permission::create(['name' => 'limpiarCarritoPedido',
                'description' => 'Limpiar carrito pedido'])->syncRoles($cliente); 
                
        Permission::create(['name' => 'quitarProductoPedido',
                'description' => 'Quitar producto de pedido'])->syncRoles($cliente); 
        
        Permission::create(['name' => 'actualizarPreProductos',
                'description' => 'Actualizar productos antes de hacer pedido'])->syncRoles($cliente); 

        Permission::create(['name' => 'actualizarProductosPedido',
                'description' => 'Actualizar productos pedido'])->syncRoles($admin); 

        Permission::create(['name' => 'agregarCarritoPedido',
                'description' => 'Agregar productos de carrito a pedido'])->syncRoles($cliente); 
                
        Permission::create(['name' => 'pedido/crear/producto/cliente',
                'description' => 'Crear pedido con producto registrado'])->syncRoles($cliente); 
                
        //-------------------------------------ABONOS---------------------------------------------
        Permission::create(['name' => 'abono/listar',
                'description' => 'Ver listado de abonos'])->syncRoles($admin, $cliente); 
        
        Permission::create(['name' => 'abono/crear',
                'description' => 'Crear abono'])->syncRoles($admin); 

        Permission::create(['name' => 'abono/ver',
                'description' => 'Ver abonos realizados'])->syncRoles($admin, $cliente); 
                
        Permission::create(['name' => 'abono/verIndividual',
                'description' => 'Ver abono individual'])->syncRoles($admin, $cliente);
    }
}
