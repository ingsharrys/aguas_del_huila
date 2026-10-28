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
        // Servidor SMTP (un solo registro)
        Schema::create('configuracion_smtp', function (Blueprint $table) {
            $table->id();
            $table->boolean('activo')->default(false);
            $table->string('host');
            $table->unsignedInteger('puerto')->default(587);
            $table->string('cifrado', 10)->nullable(); // tls, ssl o null
            $table->string('usuario')->nullable();
            $table->text('password')->nullable(); // cifrada con APP_KEY
            $table->unsignedInteger('timeout')->default(30);
            $table->string('remitente_correo');
            $table->string('remitente_nombre');
            $table->timestamps();
        });

        // Remitente y destinatarios por cada tipo de correo/formulario
        Schema::create('remitentes_correo', function (Blueprint $table) {
            $table->id();
            $table->string('clave')->unique();
            $table->string('remitente_correo')->nullable();
            $table->string('remitente_nombre')->nullable();
            $table->string('responder_a')->nullable();
            $table->text('destinatarios')->nullable(); // correos internos separados por coma
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remitentes_correo');
        Schema::dropIfExists('configuracion_smtp');
    }
};
