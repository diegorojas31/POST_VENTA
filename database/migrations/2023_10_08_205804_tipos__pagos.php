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
        Schema::create('tipos_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_pago');
            $table->string('descripcion_tipo'); 
            $table->integer('delete_tipo_pago')->default(1); // 1 ACTIVO , 0 ELIMINADO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_pagos');
    }
};
