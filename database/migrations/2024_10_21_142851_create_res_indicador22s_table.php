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
        Schema::create('res_indicador22s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("uni_id")->constrained();
            $table->unsignedBigInteger("eva_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("cri_id")->constrained();            
            $table->unsignedBigInteger("ind_id")->constrained(); 
            $table->integer('n')->nullable();
            $table->integer('nept_1')->nullable();
            $table->integer('tec_1')->nullable();            
            $table->integer('nept_2')->nullable();
            $table->integer('tec_2')->nullable();  
            $table->integer('nept_3')->nullable();
            $table->integer('tec_3')->nullable();
            $table->integer('nept_4')->nullable();
            $table->integer('tec_4')->nullable();
            $table->integer('nept_5')->nullable();
            $table->integer('tec_5')->nullable();
            $table->integer('nept_6')->nullable();
            $table->integer('tec_6')->nullable();
            $table->decimal('ttp', 8, 3)->nullable();
            $table->decimal('ttp_porcentaje', 8, 3)->nullable();
            $table->string('valoracion_22', 50)->nullable();
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
        Schema::dropIfExists('res_indicador22s');
    }
};
