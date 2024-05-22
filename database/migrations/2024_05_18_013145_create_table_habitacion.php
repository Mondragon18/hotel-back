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
        Schema::create('habitacion', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('hotel_id');
          $table->foreign('hotel_id')->references('id')->on('hoteles')->onDelete('cascade');
          $table->string('tipo');
          $table->decimal('costo_base', 8, 2);
          $table->decimal('impuestos', 8, 2);
          $table->boolean('activo')->default(true);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion');
    }
};
