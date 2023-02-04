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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('barcode', 50);
            $table->string('producto', 255);
            $table->string('marca', 50);
            $table->decimal('costo',10, 2)->default(0);
            $table->decimal('pv1',10, 2)->default(0);
            $table->decimal('cant1', 10, 2)->default(0);
            $table->decimal('pv2',10, 2);
            $table->decimal('cant2', 10, 2);
            $table->decimal('pv3',10, 2);
            $table->decimal('cant3', 10, 2);
            $table->decimal('pv4',10, 2);
            $table->decimal('cant4', 10, 2);
            $table->decimal('cant4', 10, 2);
            $table->enum('exento', ['SI', 'NO'])->default('NO');
            $table->integer('stock');
            $table->integer('alerts');
            $table->string('img', 255);
            $table->unsignedBigInteger('medida_id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('medidas_id')->references('id')->on('medidas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('productos');
    }
};
