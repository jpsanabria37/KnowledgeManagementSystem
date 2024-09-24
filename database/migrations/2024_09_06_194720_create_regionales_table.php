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
        Schema::create('regionales', function (Blueprint $table) {
            $table->id();  // Clave primaria estándar 'id'
            $table->string('nombre_regional');
            $table->string('descripcion_regional')->nullable();
            $table->string('ubicacion_regional');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regionales');
    }
};
