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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ind_id');
            $table->unsignedBigInteger('eva_id');
            $table->string('tarea');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('responsable')->nullable();
            $table->string('link')->nullable();
            
            $table->foreign('ind_id')->references('id')->on('indicadors')->onDelete('cascade');
            $table->foreign('eva_id')->references('id')->on('evaluacions')->onDelete('cascade');
            $table->foreign('responsable')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};
