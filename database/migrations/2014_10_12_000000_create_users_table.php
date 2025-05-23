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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('rol_id'); // Agrega una clave foránea a 'users'
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->unsignedBigInteger('empresa_id'); // Agrega una clave foránea a 'users'
            $table->foreign('empresa_id')->references('id')->on('empresa_clientes');
            $table->integer('delete_user')->default(1); //1 ACTIVO , 0 ELIMINADO
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
