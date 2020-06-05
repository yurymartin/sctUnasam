<?php

namespace App\Http\Controllers;

use App\Unida_Organica;
use Illuminate\Http\Request;

class UnidadesOrganicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $unidades_organicas = Unida_Organica::with('organos')->buscar($buscar)->get();
        return response()->json(['unidades_organicas' => $unidades_organicas, 'status' => 200]);
    }

    public function getUnidades_Organicas(Request $request)
    {
        $organo_id = $request->organo_id;
        $unidades_organicas = Unida_Organica::where('organo_id', '=', $organo_id)->activo()->get();
        return response()->json(['unidades_organicas' => $unidades_organicas, 'status' => 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Unida_Organica::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'la unidad organica fue insertado correctamente',
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unida_Organica  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organo = Unida_Organica::findOrFail($id)->first();
        return response()->json(['organo' => $organo, 'status' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unida_Organica  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $organo = Unida_Organica::findOrFail($id);
        $organo->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'el tipo de usuario fue actualizado correctamente',
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unida_Organica  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unida_Organica::destroy($id);
        return response()->json([
            'message' => 'el tipo de usuario fue eliminado correctamente',
            'status' => 200
        ]);
    }

    public function unidades_organicasAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $organo = Unida_Organica::findOrFail($id);
        $organo->activo = $newActivo;
        $organo->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'Cambio el estado correctamentea',
            'status' => 200
        ]);
    }
}
