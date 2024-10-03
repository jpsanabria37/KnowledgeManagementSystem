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
        Schema::create('anteproyectos', function (Blueprint $table) {

            $table->id();
            $table->string('titulo', 255); // Campo titulo con max:255
            $table->text('descripcion'); // Campo descripcion
            $table->text('objetivo_general'); // Campo objetivo_general
            $table->text('objetivos_especificos'); // Campo objetivos_especificos
            $table->text('justificacion'); // Campo justificacion
            $table->text('alcance')->nullable(); // Campo alcance
            $table->text('metodologia')->nullable(); // Campo metodologia
            $table->text('cronograma')->nullable(); // Campo cronograma
            $table->text('recursos_necesarios')->nullable(); // Campo recursos_necesarios
            $table->string('archivo_pdf')->nullable(); // Campo archivo_pdf (para el PDF)
            $table->string('archivo_poster')->nullable(); // Campo archivo_poster (PDF o imagen)
            $table->foreignId('semillero_id')->constrained('semilleros'); // Relación con la tabla 'semilleros'
            $table->enum('estado', ['en_proceso', 'aprobado', 'rechazado']); // Campo estado
            $table->date('fecha_inicio')->nullable(); // Campo fecha_inicio
            $table->date('fecha_fin')->nullable(); // Campo fecha_fin
            $table->string('realizado_por'); // Nuevo campo para quién realizó el anteproyecto
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anteproyectos');
    }
};
