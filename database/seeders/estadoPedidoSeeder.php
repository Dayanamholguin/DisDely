<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estadoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_pedidos')->insert([
            'nombre' => 'En espera',
        ]);
        DB::table('estado_pedidos')->insert([
            'nombre' => 'En proceso',
        ]);
        DB::table('estado_pedidos')->insert([
            'nombre' => 'Anulado',
        ]);
        DB::table('estado_pedidos')->insert([
            'nombre' => 'Entregado',
        ]);
    }
}
