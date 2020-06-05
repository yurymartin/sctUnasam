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
            'condicion' => 'Mayor a 65 años',
        ]);

        DB::table('condiciones')->insert([
            'condicion' => 'Hipertension Arterial',
        ]);

        DB::table('condiciones')->insert([
            'condicion' => 'Cancer',
        ]);
    }
}
