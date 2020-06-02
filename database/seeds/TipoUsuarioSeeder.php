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
            'descripcion' => 'tiene acceso a todo el sistema',
        ]);

        DB::table('tipo_usuarios')->insert([
            'tipo' => 'ENFERMERO',
            'descripcion' => 'tiene acceso al registro de temperaturas',
        ]);

        DB::table('tipo_usuarios')->insert([
            'tipo' => 'EMPLEADO',
            'descripcion' => 'tiene el acceso al perfil que le pertenece',
        ]);
    }
}
