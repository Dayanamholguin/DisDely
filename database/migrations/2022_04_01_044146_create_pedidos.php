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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idUser');  
            $table->foreign('idUser')->references('id')->on('users');

            $table->unsignedBigInteger('idCotizacion');  
            $table->foreign('idCotizacion')->references('id')->on('cotizaciones');

            $table->date('fechaEntrega');
            $table->String('descripcionGeneral',500);
            
            $table->unsignedBigInteger('estado');  
            $table->foreign('estado')->references('id')->on('estado_pedidos');

            $table->double('precio');

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
        Schema::dropIfExists('pedidos');
    }
};
