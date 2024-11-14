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
        Schema::create('objetivos_especificos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anteproyecto_id')->constrained()->onDelete('cascade');
            $table->string('nombre'); // Nombre del objetivo específico
            $table->text('recursos_necesarios')->nullable(); // Recursos necesarios para el objetivo
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos_especificos');
    }
};
