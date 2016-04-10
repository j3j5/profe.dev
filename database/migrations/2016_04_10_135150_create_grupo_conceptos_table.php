<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_conceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre');

            $table->index('nombre');
        });

        Schema::table('conceptos', function ($table) {
            $table->integer('grupo_id')->unsigned();

            $table->foreign('grupo_id')->references('id')->on('grupo_conceptos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grupo_conceptos');
    }
}
