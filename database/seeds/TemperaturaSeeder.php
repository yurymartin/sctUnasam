<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemperaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temperaturas')->insert([
            'empleado_id' => 1,
            'temperatura' => '20',
            'fecha' => Carbon::now()->toDateString(),
            'hora' => Carbon::now()->toTimeString(),
            'estado' => 'Saludable',
        ]);
    }
}
