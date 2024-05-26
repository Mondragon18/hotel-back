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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id');
            $table->unsignedBigInteger('pasajero_id');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->decimal('monto_total', 8, 2);
            $table->enum('estado', ['cancelada', 'pendiente', 'confirmada']);
            
            $table->foreign('habitacion_id')->references('id')->on('habitacion')->onDelete('cascade');
            $table->foreign('pasajero_id')->references('id')->on('pasajeros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
