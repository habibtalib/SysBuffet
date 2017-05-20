<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('marca', 45);
            $table->integer('stock');
            $table->integer('stock_minimo');
            $table->string('proveedor', 45);
            $table->float('precio_venta_unitario');
            $table->string('descripcion', 255);
            $table->dateTime('fecha_alta');
            $table->double('codigo_barras');
            $table->boolean('baja')->default(false);

            $table->integer('categoria_id')->unsigned();
            $table->string('slug', 125);
            $table->softDeletes();
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
}
