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
        Schema::create('abonos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idPedido');  
            $table->foreign('idPedido')->references('id')->on('pedidos');

            $table->String('img',500)->nullable();
            $table->double('precioPagar');

            $table->text('justificacion')->nullable();

            $table->unsignedBigInteger('estado');  
            $table->foreign('estado')->references('id')->on('estado_abonos');

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
        Schema::dropIfExists('abonos');
    }
};
