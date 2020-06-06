<?php

namespace App\Http\Controllers;

use App\Condicion;
use Illuminate\Http\Request;

class CondicionController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $condiciones = Condicion::buscar($buscar)->get();
        return response()->json(['condiciones' => $condiciones, 'status' => 200]);
    }


    public function getCondiciones(Request $request)
    {
        $buscar = $request->buscar;
        $condiciones = Condicion::buscar($buscar)->get();
        return response()->json(['condiciones' => $condiciones, 'status' => 200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Condicion::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'Condicion insertado correctamente',
            'code' => 200
        ]);
    }


    public function show($id)
    {
        $condicion = Condicion::findOrFail($id);
        return response()->json(['condicion' => $condicion, 'code' => 200]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $condicion = Condicion::findOrFail($id);
        $condicion->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'Condicion actualizado correctamente',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        Condicion::destroy($id);
        return response()->json([
            'message' => 'Condicion eliminado correctamente',
            'status' => 200
        ]);
    }

    public function condicionesAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $condicion = Condicion::findOrFail($id);
        $condicion->activo = $newActivo;
        $condicion->update();

        return response()->json([
            'activo' => $activo,
            'message' => 'Cambio el estado correctamentea',
            'status' => 200
        ]);
    }
}
