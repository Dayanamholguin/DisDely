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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idPedido');  
            $table->foreign('idPedido')->references('id')->on('pedidos');

            $table->unsignedBigInteger('idProducto');  
            $table->foreign('idProducto')->references('id')->on('productos');

            $table->String('numeroPersonas');
            $table->String('saborDeseado', 50);
            $table->String('frase', 50);
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
        Schema::dropIfExists('detalle_pedidos');
    }
};
