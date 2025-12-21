<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateIndicadorsFKRelationship7Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicadors', function (Blueprint $table) {
            $table->foreign(['for_id', 'ind_id'], 'FK_Relationship_7')->references(['id', 'ind_id'])->on('formulas')->onDelete('cascade')->onUpdate('cascade');
        });
        // Nota: Se omiten las modificaciones de AUTO_INCREMENT que causan conflictos con foreign keys
        // Las tablas ya tienen id auto_increment por defecto en Laravel
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicadors', function(Blueprint $table){
            $table->dropForeign('FK_Relationship_7');
        });
    }
}
