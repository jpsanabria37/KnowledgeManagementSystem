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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proyecto');
            $table->foreignId('id_semillero')->constrained('semilleros')->onDelete('cascade');
            $table->foreignId('id_linea')->constrained('lineas_investigacion')->onDelete('cascade');
            $table->string('tipo_contrato'); // Monitoreo, Contrato de aprendizaje, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
