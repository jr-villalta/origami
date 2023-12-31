<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('id_categoria')->references('id')->on('categorias');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->integer('precio_venta');
            $table->integer('stock_minimo');
            $table->integer('cantidad_sugerida');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
