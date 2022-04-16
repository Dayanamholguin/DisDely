<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estadoCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_cotizaciones')->insert([
            'nombre' => 'Pendiente',
        ]);
        DB::table('estado_cotizaciones')->insert([
            'nombre' => 'Rechazada',
        ]);
        DB::table('estado_cotizaciones')->insert([
            'nombre' => 'Aprobada',
        ]);
    }
}
