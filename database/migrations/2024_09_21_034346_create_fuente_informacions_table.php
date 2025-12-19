<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuenteInformacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuente_informacions', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('ind_id');
            $table->text('documento')->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'ind_id']);
            $table->foreign('ind_id', 'FK_Reference_19')->references('id')->on('indicadors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuente_informacions');
    }
}
