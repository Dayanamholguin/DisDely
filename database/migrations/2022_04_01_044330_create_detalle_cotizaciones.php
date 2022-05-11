<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idCotizacion');  
            $table->foreign('idCotizacion')->references('id')->on('cotizaciones');

            $table->unsignedBigInteger('idProducto');  
            $table->foreign('idProducto')->references('id')->on('productos');

            $table->String('numeroPersonas');
            $table->String('saborDeseado', 50);
            $table->String('frase', 50)->nullable();
            $table->String('pisos');
            $table->String('descripcionProducto', 500);
            $table->String('img',500)->nullable();
            $table->String('img2',500)->nullable();
            $table->String('img3',500)->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_cotizaciones');
    }
};
