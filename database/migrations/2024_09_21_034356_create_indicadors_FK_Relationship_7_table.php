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
        $tables=['subcriterios','formulas','indicadors','fuente_informacions','evaluacions','elemento_fundamentals','resultados'];
        foreach ($tables as $table) {
            DB::statement("ALTER TABLE $table MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT;");
        }
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
