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
        $this->call(PersonaSeeder::class);
        $this->call(CondicionSeeder::class);
        $this->call(SintomaSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(TemperaturaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
