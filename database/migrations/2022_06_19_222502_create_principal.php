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
        Schema::create('principal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('quienes');
            $table->text('productos');
            $table->String('ubicacion');
            $table->String('email');
            $table->String('celular');
            $table->String('celular2');
            $table->String('foto');
            $table->String('foto2');
            $table->String('instagram');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('principal');
    }
};
