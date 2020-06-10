<?php

namespace App\Http\Controllers;

use App\Detalle_Condicion;
use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function allEmpleados()
    {
        $empleados = User::join('personas as p', 'users.persona_id', '=', 'p.id')
            ->select('p.id', 'p.dni', 'p.nombres', 'p.apellidos', 'p.direccion', 'p.celular', 'p.email', 'p.peso', 'p.talla', 'p.imc', 'p.organo', 'p.unidad')
            ->where('users.tipo_usuario_id', '=', 3)
            ->get();

        return response()->json([
            'res' => true,
            'data' => $empleados
        ]);
    }

    public function allEmpleadosCondicion()
    {
        $empleados = Detalle_Condicion::join('personas as p', 'detalle_condiciones.persona_id', '=', 'p.id')
            ->join('users as u', 'u.persona_id', '=', 'p.id')
            ->join('condiciones as c', 'detalle_condiciones.condicion_id', '=', 'c.id')
            ->select(
                'detalle_condiciones.id',
                'p.dni',
                'p.id as persona_id',
                DB::raw('concat(p.nombres," ",p.apellidos) as persona'),
                'p.email',
                'p.direccion',
                'p.celular',
                'c.condicion',
                'p.unidad',
                'p.organo',
                DB::raw('GROUP_CONCAT(if (detalle_condiciones.respuesta, "SI", "NO") SEPARATOR ",  ") as respuesta')
            )
            ->where('u.tipo_usuario_id', '=', 3)
            ->groupBy('p.id', 'detalle_condiciones.id', 'p.dni', 'p.nombres', 'p.apellidos', 'p.email','p.direccion','p.celular','c.condicion', 'p.unidad', 'p.organo', 'detalle_condiciones.respuesta')
            ->get();

        return response()->json([
            'res' => true,
            'data' => $empleados
        ]);
    }
}
