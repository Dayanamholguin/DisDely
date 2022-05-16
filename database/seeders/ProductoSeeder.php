<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'idCategoria' => 1,
            'idSabor' => 1,
            'idEtapa' => 1,
            'nombre' => "Personalizado",
            'descripcion' => "Personalizado",
            'numeroPersonas' => 0,
            'pisos' => 0,
            'catalogo' => 0,
            'estado' => 0,
        ]);
    }
}
