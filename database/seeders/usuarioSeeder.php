<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Ibet',
            'apellido' => 'Arévalo',
            'email' => 'Ibet@gmail.com',
            'celular' => '123456',
            'estado' => 1,
            'fechaNacimiento' => "1999/12/02",
            'idGenero' => 3,
            'password' => 123456789,
            'created_at' => "2022/05/02",
            'updated_at' => "2022/05/02",
        ]);
    }
}
