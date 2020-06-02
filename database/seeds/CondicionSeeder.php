<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('condiciones')->insert([
            'condicion' => 'Saludable',
            'descripcion' => 'El empleado se encuentra bien de salud',
        ]);
    }
}
