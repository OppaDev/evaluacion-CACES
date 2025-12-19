<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('eva_uni_id');
            $table->unsignedInteger('eva_use_id');
            $table->unsignedInteger('eva_id');
            $table->unsignedInteger('ele_id')->nullable();
            $table->unsignedInteger('ele_ind_id')->nullable();
            $table->unsignedInteger('for_id')->nullable();
            $table->unsignedInteger('for_ind_id')->nullable();
            $table->unsignedInteger('esc_id')->nullable();
            $table->decimal('resultado', 8, 3)->nullable();
            $table->decimal('porcentaje', 8, 3)->nullable();
            $table->text('observacion')->nullable();
            $table->integer('estatus')->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'eva_uni_id', 'eva_id', 'eva_use_id']);
            $table->index(['ele_id', 'ele_ind_id'], 'FK_Reference_20');
            $table->index(['for_id', 'for_ind_id'], 'FK_Relationship_16');
            $table->index(['eva_id', 'eva_uni_id', 'eva_use_id'], 'FK_Relationship_4');
            $table->foreign(['ele_id', 'ele_ind_id'], 'FK_Reference_20')->references(['id', 'ind_id'])->on('elemento_fundamentals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['for_id', 'for_ind_id'], 'FK_Relationship_16')->references(['id', 'ind_id'])->on('formulas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('esc_id', 'FK_Relationship_17')->references('id')->on('escalas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['eva_id', 'eva_uni_id', 'eva_use_id'], 'FK_Relationship_4')->references(['id', 'uni_id', 'use_id'])->on('evaluacions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados');
    }
}
