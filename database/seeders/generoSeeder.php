<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class generoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generos')->insert([
            'nombre' => 'Personalizado',
        ]);
        DB::table('generos')->insert([
            'nombre' => 'Masculino',
        ]);
        DB::table('generos')->insert([
            'nombre' => 'Femenino',
        ]);
        
    }
}
