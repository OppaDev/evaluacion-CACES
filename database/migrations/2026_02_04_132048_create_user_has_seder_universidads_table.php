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
        Schema::create('user_has_seder_universidads', function (Blueprint $table) {
            $table->unsignedInteger('uni_id');
            $table->unsignedInteger('use_id');
            
            $table->primary(['uni_id', 'use_id']);
            $table->foreign('uni_id', 'FK_SedeR_Uni')->references('id')->on('universidads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_id', 'FK_SedeR_User')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_seder_universidads');
    }
};
