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
        Schema::create('res_indicador29s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("uni_id")->constrained();
            $table->unsignedInteger("eva_id")->constrained()->cascadeOnDelete();
            $table->unsignedInteger("cri_id")->constrained();            
            $table->unsignedInteger("ind_id")->constrained();            
            $table->integer('tpv')->nullable();
            $table->integer('toa')->nullable();
            $table->decimal('ipv', 8, 3)->nullable();
            $table->decimal('ipv_porcentaje', 8, 3)->nullable();
            $table->string('valoracion_29', 50)->nullable();
            $table->unsignedInteger("user_id")->constrained();
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
        Schema::dropIfExists('res_indicador29s');
    }
};
