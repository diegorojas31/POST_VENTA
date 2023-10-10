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
        Schema::create('cajaventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_caja');
            $table->foreign('id_caja')->references('id')->on('cajas');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->double('saldo_inicial', 12, 2);
            $table->double('saldo_final', 12, 2)->nullable();
            $table->datetime('fecha_apertura');
            $table->datetime('fecha_cierre')->nullable();
            $table->timestamps();
            $table->integer('delete_cajaventa')->default(1);

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajaventas');
    }
};
