<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    //GET personas
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $personas = Persona::buscar($buscar)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'pagination' => [
                'total'         => $personas->total(),
                'current_page'  => $personas->currentPage(),
                'per_page'      => $personas->perPage(),
                'last_page'     => $personas->lastPage(),
                'from'          => $personas->firstItem(),
                'to'            => $personas->lastItem(),
            ], 'personas' => $personas,
            'code' => 200
        ]);
    }

    public function getPersonas(Request $request)
    {
        $filtro = $request->filtro;
        $personas = Persona::select('id', 'dni', DB::raw('CONCAT(dni," -- ",nombres, " ", apellidos) AS persona'))
            ->buscar($filtro)
            ->Activo()
            ->get();
        return response()->json(['personas' => $personas, 'code' => 200]);
    }

    public function show($id)
    {
        $persona = Persona::with('condiciones')
            ->findOrFail($id);
        return Response()->json(['persona' => $persona, 'code' => 200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Persona::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'Empleado insertado correctamente',
            'code' => 200
        ]);
    }

    public function update(Request $request, Persona $Persona)
    {
        $input = $request->all();
        $Persona->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'Empleado actualizado correctamente',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        Persona::destroy($id);
        return response()->json([
            'message' => 'Empleado eliminado correctamente',
            'code' => 200
        ]);
    }

    public function personasAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $persona = Persona::findOrFail($id);
        $persona->activo = $newActivo;
        $persona->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'Cambio el estado correctamentea',
            'code' => 200
        ]);
    }
}
