<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario', 45);
            $table->string('password');
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->string('documento', 25);
            $table->string('email', 255);
            $table->string('telefono', 45);
            $table->string('departamento', 45);
            $table->boolean('habilitado');
            $table->rememberToken();
            $table->integer('ubicacion_id')->unsigned();
            $table->integer('rol_id')->unsigned();

            $table->string('slug', 60);
            $table->softDeletes();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
            $table->foreign('rol_id')->references('id')->on('roles');
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
        Schema::dropIfExists('usuarios');
    }
}
