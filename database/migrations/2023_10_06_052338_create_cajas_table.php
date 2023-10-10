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
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('id_ubicacion');
            $table->string('title_caja');
            $table->string('estado');
            $table->timestamps();
            $table->integer('delete_caja')->default(1);
            //FORANEO
            //$table->foreign('id_ubicacion')->references('id')->on('ubicajas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
