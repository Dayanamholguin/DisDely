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

        //-----------------------------------------------------------------------------------
        Permission::create(['name' => 'home',
                            'description' => 'Ver dashboard'])->syncRoles($admin, $cliente);
    
        //-----------------------------------------------------------------------------------
        
        Permission::create(['name' => 'rol/listar',
                            'description' => 'Ver roles'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/crear',
                            'description' => 'Crear rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/editar',
                            'description' => 'Editar rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/ver',
                            'description' => 'Ver rol'])->syncRoles($admin);
                            
        Permission::create(['name' => 'rol/cambiar/estado',
                            'description' => 'Cambiar estado de rol'])->syncRoles($admin);
        //-----------------------------------------------------------------------------------

        Permission::create(['name' => 'usuario/listar',
                            'description' => 'Ver usuarios'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/crear',
                            'description' => 'Crear usuario'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/editar',
                            'description' => 'Editar usuario'])->syncRoles($admin);

        Permission::create(['name' => 'usuario/ver',
                            'description' => 'Ver usuario'])->syncRoles($admin);        
                           
        Permission::create(['name' => 'usuario/cambiar/estado',
                            'description' => 'Camiar estado de usuario'])->syncRoles($admin);
        //-----------------------------------------------------------------------------------

        Permission::create(['name' => 'sabor/listar',
                            'description' => 'Ver listado de sabores'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/crear', 
                            'description' => 'Crear sabor'])->syncRoles($admin);
                            
        Permission::create(['name' => 'sabor/editar', 
                            'description' => 'Editar sabor'])->syncRoles($admin);

        Permission::create(['name' => 'sabor/cambiar/estado', 
                            'description' => 'Cambiar estado de sabor'])->syncRoles($admin);

        //-----------------------------------------------------------------------------------
        Permission::create(['name' => 'categoria/listar', 
                            'description' => 'Ver listado de categorías'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/crear', 
                            'description' => 'Crear categoría'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/editar', 
                            'description' => 'Editar categoría'])->syncRoles($admin);

        Permission::create(['name' => 'categoria/cambiar/estado', 
                            'description' => 'Cambiar estado de categoría'])->syncRoles($admin);

        //-----------------------------------------------------------------------------------
        Permission::create(['name' => 'producto/listar', 
                            'description' => 'Ver listado de producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/crear', 
                            'description' => 'Crear producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/editar', 
                            'description' => 'Editar Producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/ver', 
                            'description' => 'Ver información del producto'])->syncRoles($admin);

        Permission::create(['name' => 'producto/cambiar/estado', 
                            'description' => 'Cambiar estado producto'])->syncRoles($admin);
    }
}
