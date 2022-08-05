<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(RoleSeeder::class);
        $this->call(etapaSeeder::class);
        $this->call(generoSeeder::class);
        $this->call(categoriaSeeder::class);
        $this->call(estadoCotizacionSeeder::class);
        $this->call(saborSeeder::class);
        $this->call(usuarioSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(Principal::class);
        $this->call(estadoPedidoSeeder::class);
        $this->call(estadoAbonoSeeder::class);
    }
}
