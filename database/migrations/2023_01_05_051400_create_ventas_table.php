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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('condicionPago_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('tipoVenta', ['CONSUMIDOR FINAL', 'CREDITO FISCAL', 'TIQUET'])->default('TIQUET');
            $table->integer('factura');
            $table->enum('percepcion', ['SI', 'NO'])->default('NO');
            $table->date('fecha');
            $table->date('fecha2');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('condicionPago_id')->references('id')->on('condicion_pagos');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ventas');
    }
};
