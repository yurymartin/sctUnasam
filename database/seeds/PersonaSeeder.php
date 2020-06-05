<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            'dni' => '12345678',
            'nombres' => 'John',
            'apellidos' => 'Torres Salazar',
            'direccion' => 'huaraz',
            'celular' => '951 753 426',
        ]);

        DB::table('personas')->insert([
            'dni' => '87654321',
            'nombres' => 'Maria',
            'apellidos' => 'Gomez Salas',
            'direccion' => 'huaraz',
            'celular' => '987 654 001',
        ]);
    }
}
