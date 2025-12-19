<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_indicadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('eva_id');
            $table->unsignedInteger('ind_id');
            $table->text('resultado')->nullable();
            $table->text('debilidades')->nullable();
            $table->text('fortalezas')->nullable();
            $table->text('nudo')->nullable();
            $table->text('justificacion')->nullable();
            $table->foreign('eva_id', 'FK_Reference_40')->references('id')->on('evaluacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ind_id', 'FK_Reference_41')->references('id')->on('indicadors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados_indicadors');
    }
};
