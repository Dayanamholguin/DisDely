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

        //--------------------------------ROLES---------------------------------------------------
        Permission::create(['name' => 'rol/listar',
                            'description' => 'Ver listado de roles'])->assignRole($admin);

        Permission::create(['name' => 'rol/crear',
                            'description' => 'Crear rol'])->assignRole($admin);
                            
        Permission::create(['name' => 'rol/editar',
                            'description' => 'Editar rol'])->assignRole($admin);

        Permission::create(['name' => 'rol/ver',
                            'description' => 'Ver información del rol'])->assignRole($admin);

        Permission::create(['name' => 'rol/cambiar/estado',
                            'description' => 'Cambiar estado de rol'])->assignRole($admin);

        //-------------------------------SABORES----------------------------------------------------
        Permission::create(['name' => 'sabor/listar',
                            'description' => 'Ver listado de sabores'])->assignRole($admin);

        Permission::create(['name' => 'sabor/crear', 
                            'description' => 'Crear sabor'])->assignRole($admin);
                            
        Permission::create(['name' => 'sabor/editar', 
                            'description' => 'Editar sabor'])->assignRole($admin);

        Permission::create(['name' => 'sabor/cambiar/estado', 
                            'description' => 'Cambiar estado de sabor'])->assignRole($admin);

        //----------------------------------CATEGORIA-------------------------------------------------
        Permission::create(['name' => 'categoria/listar', 
                            'description' => 'Ver listado de categorías'])->assignRole($admin);

        Permission::create(['name' => 'categoria/crear', 
                            'description' => 'Crear categoría'])->assignRole($admin);

        Permission::create(['name' => 'categoria/editar', 
                            'description' => 'Editar categoría'])->assignRole($admin);

        Permission::create(['name' => 'categoria/cambiar/estado', 
                            'description' => 'Cambiar estado de categoría'])->assignRole($admin);

        //-----------------------------------PRODUCTO------------------------------------------------
        Permission::create(['name' => 'producto/listar', 
                            'description' => 'Ver listado de producto'])->assignRole($admin);

        Permission::create(['name' => 'producto/crear', 
                            'description' => 'Crear producto'])->assignRole($admin);

        Permission::create(['name' => 'producto/editar', 
                            'description' => 'Editar Producto'])->assignRole($admin);

        Permission::create(['name' => 'producto/ver', 
                            'description' => 'Ver información del producto'])->assignRole($admin);

        Permission::create(['name' => 'producto/cambiar/estado', 
                            'description' => 'Cambiar estado producto'])->assignRole($admin);

        //-----------------------------------USUARIO------------------------------------------------
        Permission::create(['name' => 'usuario/listar', 
                            'description' => 'Ver listado de usuario'])->assignRole($admin);

        Permission::create(['name' => 'usuario/crear', 
                            'description' => 'Crear usuario'])->assignRole($admin);

        Permission::create(['name' => 'usuario/editar', 
                            'description' => 'Editar usuario'])->assignRole($admin);

        Permission::create(['name' => 'usuario/ver', 
                            'description' => 'Ver información del usuario'])->assignRole($admin);

        Permission::create(['name' => 'usuario/cambiar/estado', 
                            'description' => 'Cambiar estado usuario'])->assignRole($admin);
    }
}
