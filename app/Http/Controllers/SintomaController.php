<?php

namespace App\Http\Controllers;

use App\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $sintomas = Sintoma::buscar($buscar)->get();
        return response()->json(['sintomas' => $sintomas, 'status' => 200]);
    }


    public function getSintomas()
    {
        $sintomas = Sintoma::activo()->get();
        return response()->json(['sintomas' => $sintomas, 'status' => 200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Sintoma::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'Sintoma insertado correctamente',
            'status' => 200
        ]);
    }


    public function show($id)
    {
        $sintoma = Sintoma::findOrFail($id);
        return response()->json(['sintoma' => $sintoma, 'status' => 200]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $sintoma = Sintoma::findOrFail($id);
        $sintoma->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'Sintoma actualizado correctamente',
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        Sintoma::destroy($id);
        return response()->json([
            'message' => 'Sintoma eliminado correctamente',
            'status' => 200
        ]);
    }

    public function sintomasAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $sintoma = Sintoma::findOrFail($id);
        $sintoma->activo = $newActivo;
        $sintoma->update();

        return response()->json([
            'activo' => $activo,
            'message' => 'Cambio el estado correctamentea',
            'status' => 200
        ]);
    }
}
