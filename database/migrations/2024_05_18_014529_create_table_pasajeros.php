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
        Schema::create('pasajeros', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('reserva_id');
          $table->date('fecha_nacimiento');
          $table->string('genero');
          $table->string('tipo_documento');
          $table->string('numero_documento');
          $table->string('email');
          $table->string('telefono');
          $table->timestamps();
        
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajeros');
    }
};
