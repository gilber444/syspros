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
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->string('detalle', 250);
            $table->integer('entrada')->default(0);
            $table->decimal('costoEntrada', 10, 2)->default(0);
            $table->integer('salida')->default(0);
            $table->decimal('costoSalida', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->decimal('saldo', 10, 2)->default(0);
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
        Schema::dropIfExists('kardexes');
    }
};
