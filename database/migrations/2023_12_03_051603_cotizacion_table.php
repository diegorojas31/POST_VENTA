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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->decimal('montototal', 10, 2); // Monto de la venta (decimal con 10 dígitos y 2 decimales)
            $table->date('fecha_cotizacion'); // Fecha de la venta
            $table->date('fecha_limitecot'); 
            $table->unsignedBigInteger('id_usuario'); // Agrega una clave foránea a 'users'
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('delete_cotizacion')->default(1); // 1 ACTIVO , 0 ELIMINADO

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
