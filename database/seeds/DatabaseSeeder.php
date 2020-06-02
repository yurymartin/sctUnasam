<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CondicionSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(TemperaturaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
