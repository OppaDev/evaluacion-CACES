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
        Schema::create('res_indicador19s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("uni_id")->constrained();
            $table->unsignedBigInteger("eva_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("cri_id")->constrained();            
            $table->unsignedBigInteger("ind_id")->constrained(); 
            $table->integer('n')->nullable();
            $table->integer('neg_a1_2')->nullable();
            $table->integer('neg_a1')->nullable();            
            $table->integer('neg_a2_2')->nullable();
            $table->integer('neg_a2')->nullable();  
            $table->integer('neg_a3_2')->nullable();
            $table->integer('neg_a3')->nullable();
            $table->integer('neg_a4_2')->nullable();
            $table->integer('neg_a4')->nullable();
            $table->integer('neg_a5_2')->nullable();
            $table->integer('neg_a5')->nullable();
            $table->integer('neg_a6_2')->nullable();
            $table->integer('neg_a6')->nullable();
            $table->decimal('tdg2', 8, 3)->nullable();
            $table->decimal('tdg2_porcentaje', 8, 3)->nullable();
            $table->string('valoracion_19', 50)->nullable();
            $table->unsignedBigInteger("user_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_indicador19s');
    }
};
