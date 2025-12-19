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
        Schema::create('res_indicador26s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("uni_id")->constrained();
            $table->unsignedBigInteger("eva_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("cri_id")->constrained();            
            $table->unsignedBigInteger("ind_id")->constrained(); 
            ///////////////////////////////////////////////////
            $table->integer('pia')->nullable();
            $table->integer('ptc')->nullable();
            $table->integer('pmt')->nullable();
            ///////////////////////////////////////////////////
            $table->integer('q1')->nullable();
            $table->tinyInteger('q1_ci')->nullable();            
            $table->integer('q2')->nullable();
            $table->integer('q2_ci')->nullable();
            $table->integer('q3')->nullable();
            $table->integer('q3_ci')->nullable();
            $table->integer('q4')->nullable();
            $table->integer('q4_ci')->nullable();
            $table->integer('aci')->nullable();
            $table->integer('aci_ci')->nullable();
            $table->integer('br')->nullable();
            $table->integer('br_ci')->nullable();
            $table->integer('la')->nullable();
            $table->integer('la_ci')->nullable();
            $table->decimal('pac', 8, 3)->nullable();
            //////////////////////////////////////////////////
            $table->integer('opi')->nullable();
            $table->integer('opn')->nullable();
            $table->decimal('pa', 8, 3)->nullable();
            //////////////////////////////////////////////////
            $table->integer('li')->nullable();
            $table->integer('cl')->nullable();
            $table->integer('tc')->nullable();
            $table->decimal('lycl', 8, 3)->nullable();
            //////////////////////////////////////////////////
            $table->decimal('ip', 8, 3)->nullable();
            $table->decimal('ip_porcentaje', 8, 3)->nullable();
            $table->string('valoracion_26', 50)->nullable();
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
        Schema::dropIfExists('res_indicador26s');
    }
};
