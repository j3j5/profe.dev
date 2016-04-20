<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeGustasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('me_gustas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titulo')->nullable();
            $table->string('imagen');
            $table->string('autor')->nullable();
            $table->integer('curso');
            $table->integer('propuesta_id')->unsigned();
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('me_gustas');
    }
}
