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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();

            $table->unsignedBigInteger('idRol');  
            $table->foreign('idRol')->references('id')->on('roles');
            $table->unsignedBigInteger('idCiudad');  
            $table->foreign('idCiudad')->references('id')->on('ciudades');

            $table->String('celular',13);
            $table->String('celularAlternativo',13)->nullable();
            $table->boolean('estado');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
