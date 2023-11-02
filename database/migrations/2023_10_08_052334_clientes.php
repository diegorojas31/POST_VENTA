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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('apellido_cliente');
            $table->bigInteger('nit_cliente')->nullable();
            $table->bigInteger('celular_cliente')->nullable(); 
            $table->unsignedBigInteger('empresa_id'); // Agrega una clave foránea a 'users'
            $table->foreign('empresa_id')->references('id')->on('empresa_clientes');
            $table->integer('delete_cliente')->default(1); // 1 ACTIVO , 0 ELIMINADO
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
