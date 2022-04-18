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
        $admin = Role::create(['name' => 'Admin']);
        $cliente = Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'home'])->syncRoles($admin, $cliente);

        Permission::create(['name' => 'sabor/listar'])->assignRole($admin);
        Permission::create(['name' => 'sabor/crear'])->assignRole($admin);
        Permission::create(['name' => 'sabor/guardar'])->assignRole($admin);
        Permission::create(['name' => 'sabor/editar'])->assignRole($admin);
        Permission::create(['name' => 'sabor/actualizar'])->assignRole($admin);
        Permission::create(['name' => 'sabor/cambiar/estado']);

        Permission::create(['name' => 'categoria/listar'])->assignRole($admin);
        Permission::create(['name' => 'categoria/crear'])->assignRole($admin);
        Permission::create(['name' => 'categoria/guardar'])->assignRole($admin);
        Permission::create(['name' => 'categoria/editar'])->assignRole($admin);
        Permission::create(['name' => 'categoria/actualizar'])->assignRole($admin);
        Permission::create(['name' => 'categoria/cambiar/estado'])->assignRole($admin);

        Permission::create(['name' => 'producto/listar']);
        Permission::create(['name' => 'producto/crear']);
        Permission::create(['name' => 'producto/guardar']);
        Permission::create(['name' => 'producto/editar']);
        Permission::create(['name' => 'producto/ver']);
        Permission::create(['name' => 'producto/actualizar']);
        Permission::create(['name' => 'producto/cambiar/estado']);
    }
}
