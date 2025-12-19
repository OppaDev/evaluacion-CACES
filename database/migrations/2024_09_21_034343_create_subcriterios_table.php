<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriterios', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('cri_id');
            $table->string('subcriterio', 254)->nullable();
            $table->decimal('porcentaje', 8, 3)->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'cri_id']);
            $table->foreign('cri_id', 'FK_Relationship_13')->references('id')->on('criterios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcriterios');
    }
}
