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
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('logo_empresa')->nullable(); // Puede ser nulo
            $table->string('nombre_empresa')->nullable(); // Puede ser nulo
            $table->string('direccion')->nullable(); // Puede ser nulo
            $table->string('correo')->nullable(); // Puede ser nulo
            $table->string('numero_telefono')->nullable(); // Puede ser nulo
            $table->string('url_sitio')->nullable(); // Puede ser nulo
            $table->decimal('iva', 8, 2)->nullable();
            $table->timestamps(); // Esto agrega las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
