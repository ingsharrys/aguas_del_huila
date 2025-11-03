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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Texto principal del banner
            $table->string('subtitulo')->nullable(); // Texto secundario (opcional)
            $table->string('boton')->nullable(); // Texto del botón
            $table->string('enlace')->nullable(); // Enlace del botón
            $table->string('imagen')->nullable(); // Ruta de la imagen del banner
            $table->boolean('activo')->default(true); // Control para mostrar/ocultar el banner
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
