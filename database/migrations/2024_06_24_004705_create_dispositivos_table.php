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
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->string('nom_dispositivo');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('bodega_id');
            $table->timestamps();
            $table->foreign('modelo_id')->references('id')->on('modelos');
            $table->foreign('bodega_id')->references('id')->on('bodegas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
