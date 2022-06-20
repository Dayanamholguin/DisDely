<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class principal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('principal')->insert([
            'quienes' => 'Somos un negocio dedicado a la producción de productos de pastelería de alta calidad y sabor; ubicada en Bello, Las Vegas. Ofrecemos a nuestros clientes productos de la mejor calidad y frescura. Contamos con una amplia gama de variedades en pan, repostería y pasteles de línea para todo tipo de gusto.',
            'productos' => 'Acá podrás ver los últimos productos registrados en el sistema, tenemos más productos para mostrarte dentro del aplicativo',
            'ubicacion' => 'Av 67 #67 - 78 | Bello, Las Vegas',
            'email' => 'disdely.dulcencanto@gmail.com',
            'celular' => '3127018618',
            'celular2' => '3106368657',
            'foto' => 'harinas.jpg',
            'foto2' => 'preparar.png',
            'instagram' => 'https://www.instagram.com/dulce_encanto_20205/'
        ]);
    }
}
