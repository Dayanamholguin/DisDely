<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoDocumentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documentos')->insert([
            'nombre' => 'C.C',
        ]);
        DB::table('tipo_documentos')->insert([
            'nombre' => 'T.I',
        ]);
    }
}
