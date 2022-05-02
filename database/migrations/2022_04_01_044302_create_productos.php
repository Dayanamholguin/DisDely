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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idCategoria');  
            $table->foreign('idCategoria')->references('id')->on('categorias');

            $table->unsignedBigInteger('idSabor');  
            $table->foreign('idSabor')->references('id')->on('sabores');

            $table->unsignedBigInteger('idEtapa');  
            $table->foreign('idEtapa')->references('id')->on('etapas');

            $table->String('nombre',80);
            $table->String('descripcion',500);
            $table->String('img',500);
            $table->String('img2',500)->nullable();
            $table->String('img3',500)->nullable();
            $table->String('numeroPersonas');
            $table->String('pisos');
            $table->boolean('catalogo');
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
