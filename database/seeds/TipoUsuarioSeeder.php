<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuarios')->insert([
            'tipo' => 'ADMINISTRADOR',
            'key' => bcrypt('administrador'),
            'descripcion' => 'tipo de usuario que tiene acceso a todo el sistema',
        ]);

        DB::table('tipo_usuarios')->insert([
            'tipo' => 'MEDICO',
            'key' => bcrypt('medico'),
            'descripcion' => 'tipo de usuario que tiene acceso solo a registrar la temperatura',
        ]);

        DB::table('tipo_usuarios')->insert([
            'tipo' => 'EMPLEADO',
            'key' => bcrypt('empleado'),
            'descripcion' => 'tipo de usuaro que tiene solo acceso a su perfil',
        ]);
    }
}
