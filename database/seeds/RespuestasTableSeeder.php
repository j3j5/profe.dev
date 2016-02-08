<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RespuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('respuestas')->insert([
            'respuesta'     => "El uno",
            'pregunta_id'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El dos",
            'pregunta_id'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El tres",
            'pregunta_id'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El cuatro",
            'pregunta_id'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El uno",
            'pregunta_id'   => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El dos",
            'pregunta_id'   => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El tres",
            'pregunta_id'   => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El cuatro",
            'pregunta_id'   => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El uno",
            'pregunta_id'   => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El dos",
            'pregunta_id'   => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El tres",
            'pregunta_id'   => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El cuatro",
            'pregunta_id'   => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El uno",
            'pregunta_id'   => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El dos",
            'pregunta_id'   => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El tres",
            'pregunta_id'   => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "El cuatro",
            'pregunta_id'   => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "La A",
            'pregunta_id'   => 5,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "La B",
            'pregunta_id'   => 5,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "La C",
            'pregunta_id'   => 5,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('respuestas')->insert([
            'respuesta'     => "La D",
            'pregunta_id'   => 5,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
