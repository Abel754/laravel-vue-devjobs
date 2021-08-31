<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Front End',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Back End',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Full Stack',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'DBA',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'UX / UI',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'TechLead',
            'created_at' => Carbon::now(), // Utilitzem Carbon que és el que utiltiza Laravel per gestionar les dates
            'updated_at' => Carbon::now(),
        ]);
    }
}
