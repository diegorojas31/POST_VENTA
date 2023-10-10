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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empleado');
            $table->string('apellido_empleado');
            $table->integer('celular_empleado');
            $table->unsignedBigInteger('usuario_id'); // Agrega una clave foránea a 'users'
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->integer('delete_empleado')->default(1); //1 ACTIVO , 0 ELIMINADO


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
