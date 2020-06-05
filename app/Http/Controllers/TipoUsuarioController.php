<?php

namespace App\Http\Controllers;

use App\Tipo_Usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $tipo_usuarios = Tipo_Usuario::buscar($buscar)->get();
        return response()->json(['tipo_usuarios' => $tipo_usuarios, 'code' => 200]);
    }

    public function getTipo_usuario()
    {
        $tipo_usuarios = Tipo_Usuario::activo()->get();
        return response()->json(['tipo_usuarios' => $tipo_usuarios, 'code' => 200]);
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
        Tipo_Usuario::create($input);
        return response()->json([
            'data' => $input,
            'message' => 'el tipo de usuario fue insertado correctamente',
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipo_Usuario  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_usuario = Tipo_Usuario::findOrFail($id)->first();
        return response()->json(['tipo_usuario' => $tipo_usuario, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipo_Usuario  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $tipo_usuario = Tipo_Usuario::findOrFail($id);
        $tipo_usuario->update($input);

        return response()->json([
            'data' => $input,
            'message' => 'el tipo de usuario fue actualizado correctamente',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo_Usuario  $tipo_Usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tipo_Usuario::destroy($id);
        return response()->json([
            'message' => 'el tipo de usuario fue eliminado correctamente',
            'code' => 200
        ]);
    }

    public function tipo_usuariosAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $tipo_usuario = Tipo_Usuario::findOrFail($id);
        $tipo_usuario->activo = $newActivo;
        $tipo_usuario->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'Cambio el estado correctamentea',
            'code' => 200
        ]);
    }
}
