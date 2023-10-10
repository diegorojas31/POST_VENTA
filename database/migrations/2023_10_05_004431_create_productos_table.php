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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('medida_id');
            $table->string('nombre', 50)->default('');
            $table->text('descripcion')->nullable()->default('');
            $table->float('precio')->default(0);
            $table->string('tipo_codigo')->default('EAN8');
            $table->string('barcode')->default('');
            $table->string('marca', 50)->nullable()->default('');
            $table->string('image')->nullable();
            $table->integer('delete_producto')->default(1);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('medida_id')->references('id')->on('medidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
