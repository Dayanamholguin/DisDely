<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'Cliente genérico',
            'apellido' => 'Cliente genérico',
            'email' => 'Clientegenérico@gmail.com',
            'celular' => '0',
            'celularAlternativo' => '0',
            'estado' => 0,
            'foto' =>'undraw_profile_1.svg',
            'idGenero' => 1,
            'password' => Hash::make("123456789"),
            'created_at' => "2022/05/02",
            'updated_at' => "2022/05/02",
        ])->assignRole('cliente');
        
        User::create([
            'nombre' => 'Ibet',
            'apellido' => 'Arévalo',
            'email' => 'disdely.dulcencanto@gmail.com',
            'celular' => '123456',
            'celularAlternativo' => '4566578',
            'estado' => 1,
            'foto' =>'undraw_profile_3.svg',
            'idGenero' => 3,
            'password' => Hash::make("123456789"),
            'created_at' => "2022/05/02",
            'updated_at' => "2022/05/02",
        ])->assignRole('admin');

        


    }
}
