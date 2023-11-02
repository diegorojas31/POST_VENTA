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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes'); 
            $table->string('razon_social'); 
            $table->decimal('subtotal_venta', 10, 2);
            $table->decimal('montototal_venta', 10, 2); 
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->integer('delete_venta')->default(1); // 1 ACTIVO , 0 ELIMINADO

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
