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
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->text('objetivo_general');
            $table->text('justificacion')->nullable();
            $table->text('alcance')->nullable();
            $table->text('metodologia')->nullable();
            $table->string('archivo_poster')->nullable(); // Ruta al archivo poster
            $table->foreignId('semillero_id')->constrained()->onDelete('cascade'); // Relación con semillero
            $table->enum('estado_aprobacion', ['en_proceso', 'aprobado', 'rechazado'])->default('en_proceso'); // Estado predeterminado
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario creador del anteproyecto
            $table->json('colaboradores')->nullable(); // Colaboradores adicionales como JSON
            $table->enum('estado_creacion', ['incompleto', 'completo', 'enviado'])->default('incompleto');
            $table->integer('paso_actual')->default(1);
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
