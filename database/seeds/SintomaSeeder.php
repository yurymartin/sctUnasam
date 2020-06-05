<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SintomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sintomas')->insert([
            'sintoma' => 'Sensación de alza termica o fiebre',
        ]);

        DB::table('sintomas')->insert([
            'sintoma' => 'Tos, estornudo o dificultad para respirar',
        ]);
    }
}
