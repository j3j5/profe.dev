<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PreguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es el primero de los números?",
            'practica'      => false,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es el segundo de los números?",
            'practica'      => false,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es el tercero de los números?",
            'practica'      => false,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es el cuarto de los números?",
            'practica'      => false,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es la primera de las letras?",
            'practica'      => true,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es la segunda de las letras?",
            'practica'      => true,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('preguntas')->insert([
            'pregunta'      => "¿Cuál es la tercera de las letras?",
            'practica'      => true,
            'curso'         => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
