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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            //$table->string('ubicacion', 50)->nullable()->default('');
            $table->unsignedBigInteger('almacen_id')->nullable();;
            $table->integer('cantidad')->default(0);
            $table->integer('minimo')->default(0);
            $table->integer('maximo')->default(0);
            $table->integer('delete_stock')->default(0);
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('almacen_id')->references('id')->on('almacens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
