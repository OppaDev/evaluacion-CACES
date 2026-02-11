<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('ind_id');
            $table->unsignedInteger('eva_id');
            $table->string('tarea');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('estado')->nullable();
            $table->unsignedInteger('responsable')->nullable();
            $table->text('link')->nullable();
            
            // Indexes
            $table->index('ind_id', 'ind_id');
            $table->index('eva_id', 'eva_id');
            $table->index('responsable', 'tarea_has_responsable');

            // Foreign Keys
            $table->foreign('responsable', 'tarea_has_responsable')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ind_id', 'tareas_ibfk_1')->references('id')->on('indicadors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('eva_id', 'tareas_ibfk_2')->references('id')->on('evaluacions')->onDelete('cascade')->onUpdate('cascade');
           
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
