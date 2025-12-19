<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universidads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('universidad', 254)->nullable();
            $table->string('foto', 254)->nullable();
            $table->string('campus', 254)->nullable();
            $table->string('sede', 254)->nullable();
            $table->string('ciudad', 254)->nullable();
            $table->string('informe', 254)->nullable();
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
        Schema::dropIfExists('universidads');
    }
}
