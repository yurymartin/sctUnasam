<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    //GET empleados
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $empleados = Empleado::with('condiciones')
            ->buscar($buscar)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'pagination' => [
                'total'         => $empleados->total(),
                'current_page'  => $empleados->currentPage(),
                'per_page'      => $empleados->perPage(),
                'last_page'     => $empleados->lastPage(),
                'from'          => $empleados->firstItem(),
                'to'            => $empleados->lastItem(),
            ], 'empleados' => $empleados,
            'code' => 200
        ]);
    }

    public function getEmpleados(Request $request)
    {
        $filtro = $request->filtro;
        $empleados = Empleado::with('condiciones')
            ->select('id', 'dni', DB::raw('CONCAT(dni," -- ",nombres, " ", apellidos) AS empleado'))
            ->buscar($filtro)
            ->Activo()
            ->get();
        return response()->json(['empleados' => $empleados, 'code' => 200]);
    }

    public function show($id)
    {
        $empleado = Empleado::with('condiciones')
            ->findOrFail($id);
        return Response()->json(['empleado' => $empleado, 'code' => 200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Empleado::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'Empleado insertado correctamente',
            'code' => 200
        ]);
    }

    public function update(Request $request, Empleado $empleado)
    {
        $input = $request->all();
        $empleado->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'Empleado actualizado correctamente',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        Empleado::destroy($id);
        return response()->json([
            'message' => 'Empleado eliminado correctamente',
            'code' => 200
        ]);
    }

    public function empleadosAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $empleado = Empleado::findOrFail($id);
        $empleado->activo = $newActivo;
        $empleado->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'Cambio el estado correctamentea',
            'code' => 200
        ]);
    }
}
