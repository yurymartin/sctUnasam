<?php

namespace App\Http\Controllers;

use App\Detalle_Condicion;
use App\Detalle_Ficha;
use App\Detalle_Sintoma;
use App\Organo;
use App\Persona;
use App\Unida_Organica;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuramentacionController extends Controller
{
    public function store(Request $request)
    {
        $persona_id = $request->persona_id;
        $dataCondiciones = $request->dataCondiciones;
        $dataSintomas = $request->dataSintomas;
        $unidad_id = $request->unidad_id;

        foreach ($dataCondiciones as $data) {
            $detalle_condiciones = new Detalle_Condicion();
            $detalle_condiciones->persona_id = $persona_id;
            $detalle_condiciones->condicion_id = $data['id'];
            $detalle_condiciones->respuesta = $data['respuesta'];
            $detalle_condiciones->save();
        }

        $detalle_ficha = new Detalle_Ficha();
        $detalle_ficha->persona_id = $persona_id;
        $detalle_ficha->unidades_organica_id = $unidad_id;
        $detalle_ficha->fecha = Carbon::now()->toDateString();
        $detalle_ficha->hora = Carbon::now()->toTimeString();
        $detalle_ficha->save();


        foreach ($dataSintomas as $data) {
            $detalle_sintomas = new Detalle_Sintoma();
            $detalle_sintomas->persona_id = $persona_id;
            $detalle_sintomas->sintoma_id = $data['id'];
            $detalle_sintomas->respuesta = $data['respuesta'];
            $detalle_sintomas->save();
        }

        return response()->json([
            "res" => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function declaracion(Request $request)
    {
        $dataCondiciones = $request->dataCondiciones;

        $persona = new Persona();
        $persona->dni = $request->dni;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->peso = $request->peso;
        $persona->talla = $request->talla;
        $persona->imc = $request->imc;
        $persona->direccion = $request->direccion;
        $persona->celular = $request->celular;
        $persona->email = $request->email;
        $persona->organo = $request->organo;
        $persona->unidad = $request->unidad;
        $persona->save();

        foreach ($dataCondiciones as $data) {
            $detalle_condiciones = new Detalle_Condicion();
            $detalle_condiciones->persona_id = $persona->id;
            $detalle_condiciones->condicion_id = $data['id'];
            $detalle_condiciones->respuesta = $data['respuesta'];
            $detalle_condiciones->save();
        }

        $newUser = new User();
        $newUser->persona_id = $persona->id;
        $newUser->tipo_usuario_id = 3;
        $newUser->name = $request->nombres;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->save();

        return response()->json([
            "res" => true,
        ]);
    }

    public function verifyDocumento($id)
    {
        $detalle_condiciones = Detalle_Condicion::where('persona_id', '=', $id)->get();

        return response()->json([
            'detalle_condiciones' => $detalle_condiciones,
            'res' => true,
            'status' => 200
        ]);
    }
}
