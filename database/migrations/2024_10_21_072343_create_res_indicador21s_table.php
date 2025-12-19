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
        Schema::create('res_indicador21s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("uni_id")->constrained();
            $table->unsignedBigInteger("eva_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("cri_id")->constrained();            
            $table->unsignedBigInteger("ind_id")->constrained(); 
            $table->integer('n')->nullable();
            $table->integer('negt_1')->nullable();
            $table->integer('teg_1')->nullable();            
            $table->integer('negt_2')->nullable();
            $table->integer('teg_2')->nullable();  
            $table->integer('negt_3')->nullable();
            $table->integer('teg_3')->nullable();
            $table->integer('negt_4')->nullable();
            $table->integer('teg_4')->nullable();
            $table->integer('negt_5')->nullable();
            $table->integer('teg_5')->nullable();
            $table->integer('negt_6')->nullable();
            $table->integer('teg_6')->nullable();
            $table->decimal('ttg', 8, 3)->nullable();
            $table->decimal('ttg_porcentaje', 8, 3)->nullable();
            $table->string('valoracion_21', 50)->nullable();
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
        Schema::dropIfExists('res_indicador21s');
    }
};
