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
        Schema::create('hoteles', function (Blueprint $table) {
          $table->id();
          $table->string('nombre');
          $table->string('direccion'); // Añadido campo dirección
          $table->string('ciudad');
          $table->string('pais');
          $table->string('telefono');
          $table->string('email');
          $table->string('clasificacion'); // Quizás puede ser integer si es numérica
          $table->json('servicios')->nullable(); // Cambiado a text si la lista de servicios es larga
          $table->text('descripcion')->nullable(); // Cambiado a text y nullable
          $table->date('fecha_apertura')->nullable(); // Cambiado a date
          $table->string('pagina_web')->nullable(); // Añadido nullable
          $table->text('imagenes')->nullable(); // Usar json para almacenar múltiples URLs de imágenes
          $table->boolean('activo')->default(true);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoteles');
    }
};
