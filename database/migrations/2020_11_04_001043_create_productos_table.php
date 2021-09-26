<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
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
            $table->integer('idUsuario')->unsigned();
            $table->string('nombreDelProducto');
            $table->string('codigoDelProducto');
            $table->string('descripcionDelProducto');
            $table->integer('cantidadDelProducto');
            $table->decimal('precioDelProducto');
            $table->string('proveedorDelProducto');
            $table->integer('alerta');
            $table->timestamps();

            //relacion con Usuario
            $table->foreign('idUsuario')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUdpate('cascade');
        });
        Schema::create('codigos', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario')->unsigned();
            $table->integer('idProducto')->unsigned();
            $table->string('codigo');
            $table->string('nombreDelProducto');
            $table->timestamps();
            //relacion
            $table->foreign('idUsuario')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('idProducto')->references('id')->on('productos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('codigos');
    }

}
