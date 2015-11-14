<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Julio",
            'email' => 'julioelpoeta@gmail.com',
            'password' => bcrypt('4321'),
        ]);

        DB::table('users')->insert([
            'name' => "Mariana",
            'email' => 'mcastanioceppi@gmail.com',
            'password' => bcrypt('4321'),
        ]);

    }
}
