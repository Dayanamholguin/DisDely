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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idUser');  
            $table->foreign('idUser')->references('id')->on('users');

            $table->unsignedBigInteger('idTipoCotizacion');  
            $table->foreign('idTipoCotizacion')->references('id')->on('tipo_cotizaciones');

            $table->date('fechaEntrega');
            $table->text('descripcionGeneral');
            
            $table->unsignedBigInteger('estado');  
            $table->foreign('estado')->references('id')->on('estado_cotizaciones');

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
        Schema::dropIfExists('cotizaciones');
    }
};
