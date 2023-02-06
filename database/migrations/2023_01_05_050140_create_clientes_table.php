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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCliente', 150);
            $table->string('dui', 10)->nullable();
            $table->string('nit', 20)->nullable();
            $table->string('homologado', 5)->default('SI', 'NO');
            $table->string('registro', 50)->nullable();
            $table->string('giro', 150)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('telefono', 9)->nullable();
            $table->enum('tipo', ['CLIENTE', 'ESCUELA', 'PROVEEDOR'])->default('CLIENTE');
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
        Schema::dropIfExists('clientes');
    }
};
