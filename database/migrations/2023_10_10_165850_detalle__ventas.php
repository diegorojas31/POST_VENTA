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
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal', 10, 2); //El costo total del artículo o servicio multiplicado por la cantidad.
            $table->integer('cantidad'); 
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('stocks');
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->integer('delete_detalle_venta')->default(1); // 1 ACTIVO , 0 ELIMINADO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
