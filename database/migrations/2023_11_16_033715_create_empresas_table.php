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
        Schema::create('empresas', function (Blueprint $table) {
            $table->string('user_email');
            $table->foreign('user_email')->references('email')->on('users');
            $table->string('razon_social');
            $table->string('giro');
            $table->string('nit');
            $table->boolean('exenta_iva');
            $table->string('registro_iva');
            $table->timestamps(); // Si deseas habilitar las marcas de tiempo created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
