<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cotizaciones')->insert([
            'nombre' => 'Personalizado',
        ]);
        DB::table('tipo_cotizaciones')->insert([
            'nombre' => 'Normal',
        ]);
    }
}
