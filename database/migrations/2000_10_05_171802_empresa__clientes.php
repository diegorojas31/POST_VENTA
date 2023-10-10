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
        Schema::create('empresa_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->bigInteger('nit_empresa')->nullable(); 
            $table->string('nombre_titular');
            $table->string('apellido_titular');
            $table->bigInteger('celular_titular'); 
            $table->integer('delete_empresa')->default(1); //1 ACTIVO , 0 ELIMINADO
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_clientes');
    }
};
