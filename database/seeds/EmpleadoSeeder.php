<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            'condicion_id' => 1,
            'dni' => '88888888',
            'nombres' => 'admin',
            'apellidos' => 'admin',
            'edad' => 20,
            'genero' => 'MASCULINO',
        ]);
    }
}
