<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('fecha');
            $table->integer('estado_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->text('observacion')->nullable();
            $table->softDeletes();

            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->integer('pedido_id')->unsigned();
            $table->integer('cantidad');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
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
}
