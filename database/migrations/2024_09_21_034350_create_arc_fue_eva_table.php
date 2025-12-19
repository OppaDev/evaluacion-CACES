<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArcFueEvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arc_fue_eva', function (Blueprint $table) {
            $table->unsignedInteger('arc_id');
            $table->unsignedInteger('fue_id');
            $table->unsignedInteger('uni_id');
            $table->unsignedInteger('use_id');
            $table->unsignedInteger('eva_id');
            $table->unsignedInteger('fue_ind_id')->nullable();
            
            $table->primary(['uni_id', 'use_id', 'arc_id', 'fue_id', 'eva_id']);
            $table->index(['fue_id', 'fue_ind_id'], 'FK_Reference_17');
            $table->index(['eva_id', 'uni_id', 'use_id'], 'FK_Reference_18');
            $table->foreign('arc_id', 'FK_Reference_16')->references('id')->on('archivos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['fue_id', 'fue_ind_id'], 'FK_Reference_17')->references(['id', 'ind_id'])->on('fuente_informacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['eva_id', 'uni_id'], 'FK_Reference_18')->references(['id', 'uni_id'])->on('evaluacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['use_id'], 'FK_Reference_30')->references(['id'])->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arc_fue_eva');
    }
}
