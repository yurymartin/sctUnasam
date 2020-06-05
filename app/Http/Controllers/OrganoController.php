<?php

namespace App\Http\Controllers;

use App\Organo;
use Illuminate\Http\Request;

class OrganoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $organos = Organo::buscar($buscar)->get();
        return response()->json(['organos' => $organos, 'status' => 200]);
    }

    public function getOrganos()
    {
        $organos = Organo::activo()
            ->get();
        return response()->json(['organos' => $organos, 'status' => 200]);
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
        Organo::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'el tipo de usuario fue insertado correctamente',
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organo  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organo = Organo::findOrFail($id)->first();
        return response()->json(['organo' => $organo, 'status' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organo  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $organo = Organo::findOrFail($id);
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
     * @param  \App\Organo  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organo::destroy($id);
        return response()->json([
            'message' => 'el tipo de usuario fue eliminado correctamente',
            'status' => 200
        ]);
    }

    public function organosAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $organo = Organo::findOrFail($id);
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
