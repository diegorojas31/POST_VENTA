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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventario_id');
            $table->unsignedBigInteger('id_empresa');
            $table->string('nombre', 150)->nullable()->default('');
            $table->string('descripcion', 150)->nullable()->default('');
            $table->integer('delete_almacen')->default(1);
            $table->timestamps();

            $table->foreign('id_empresa')->references('id')->on('empresa_clientes');
            $table->foreign('inventario_id')->references('id')->on('inventarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacens');
    }
};
