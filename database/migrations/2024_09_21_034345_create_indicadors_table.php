<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_id')->nullable();
            $table->unsignedInteger('sub_cri_id')->nullable();
            $table->unsignedInteger('for_id')->nullable();
            $table->unsignedInteger('ind_id')->nullable();
            $table->unsignedInteger('cri_id')->nullable();
            $table->string('indicador', 254)->nullable();
            $table->text('estandar')->nullable();
            $table->text('periodo')->nullable();
            $table->decimal('porcentaje', 8, 3)->nullable();
            $table->timestamps();
            
            $table->index(['sub_id', 'sub_cri_id'], 'FK_Relationship_14');
            $table->foreign(['sub_id', 'sub_cri_id'], 'FK_Relationship_14')->references(['id', 'cri_id'])->on('subcriterios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cri_id', 'FK_Relationship_15')->references('id')->on('criterios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadors');
    }
}
