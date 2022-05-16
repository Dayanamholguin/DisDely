<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class etapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('etapas')->insert([
            'nombre' => 'Personalizado',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Para todos',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Bebé',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Niño(a)',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Adolescente',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Joven',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Adulto',
        ]);
        DB::table('etapas')->insert([
            'nombre' => 'Adulto mayor',
        ]);
    }
}
