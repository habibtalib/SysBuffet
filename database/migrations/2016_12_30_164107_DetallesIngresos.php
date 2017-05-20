<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallesIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cantidad');
            $table->float('precio_total');
            $table->string('descripcion', 255)->nullable();
            $table->date('fecha');

            $table->integer('tipo_ingreso_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->foreign('tipo_ingreso_id')->references('id')->on('tipos_ingresos');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->softDeletes();
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
        Schema::dropIfExists('detalles_ingresos');
    }
}
