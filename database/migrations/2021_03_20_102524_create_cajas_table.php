<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->integer('idUsuario')->unsigned();
            $table->datetime('fechaApertura');
            $table->datetime('fechaCierre')->nullable();
            $table->decimal('saldoInicial');
            $table->decimal('saldoDeCierre');
            $table->string('descripcion');
            $table->string('estado');
            $table->timestamps();
            //relacion con Usuario
            $table->foreign('idUsuario')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUdpate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
