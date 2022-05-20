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
            'nombre' => 'Ibet',
            'apellido' => 'Arévalo',
            'email' => 'Ibet@gmail.com',
            'celular' => '123456',
            'celularAlternativo' => '4566578',
            'estado' => 1,
            'idGenero' => 3,
            'password' => Hash::make("123456789"),
            'created_at' => "2022/05/02",
            'updated_at' => "2022/05/02",
        ])->assignRole('admin');


    }
}
