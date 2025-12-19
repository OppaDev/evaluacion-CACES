<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('uni_id');
            $table->unsignedInteger('use_id');
            $table->date('fecha_creacion')->nullable();
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_final')->nullable();
            $table->integer('informe')->nullable();
            $table->string('facultad', 254)->nullable();
            $table->string('departamento', 254)->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'uni_id', 'use_id']);
            $table->foreign('uni_id', 'FK_Relationship_2')->references('id')->on('universidads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_id', 'FK_Relationship_3')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacions');
    }
}
