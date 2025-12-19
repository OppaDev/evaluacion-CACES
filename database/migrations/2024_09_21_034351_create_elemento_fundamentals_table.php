<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementoFundamentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemento_fundamentals', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('ind_id');
            $table->text('elemento')->nullable();
            $table->decimal('porcentaje', 8, 3)->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'ind_id']);
            $table->foreign('ind_id', 'FK_Relationship_10')->references('id')->on('indicadors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elemento_fundamentals');
    }
}
