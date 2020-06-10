<?php

namespace App\Http\Controllers;

use App\Detalle_Sintoma;
use App\FichaSintomatica;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FichaSintomaticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $persona_id = $request->persona_id;
        $date = $request->date;
        $fichas_sintomaticas = FichaSintomatica::with('personas')->where('persona_id', $persona_id)->where('fecha', $date)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'pagination' => [
                'total'         => $fichas_sintomaticas->total(),
                'current_page'  => $fichas_sintomaticas->currentPage(),
                'per_page'      => $fichas_sintomaticas->perPage(),
                'last_page'     => $fichas_sintomaticas->lastPage(),
                'from'          => $fichas_sintomaticas->firstItem(),
                'to'            => $fichas_sintomaticas->lastItem(),
            ], 'fichas_sintomaticas' => $fichas_sintomaticas,
            'code' => 200
        ]);
    }


    public function getFichas(Request $request)
    {
        $fichas_sintomaticas = FichaSintomatica::with('personas')
            ->where('activo', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'pagination' => [
                'total'         => $fichas_sintomaticas->total(),
                'current_page'  => $fichas_sintomaticas->currentPage(),
                'per_page'      => $fichas_sintomaticas->perPage(),
                'last_page'     => $fichas_sintomaticas->lastPage(),
                'from'          => $fichas_sintomaticas->firstItem(),
                'to'            => $fichas_sintomaticas->lastItem(),
            ], 'fichas_sintomaticas' => $fichas_sintomaticas,
            'code' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fichas_sintomatica = new FichaSintomatica();
        $fichas_sintomatica->persona_id = $request->persona_id;
        $fichas_sintomatica->fecha = Carbon::now()->toDateString();
        $fichas_sintomatica->hora = Carbon::now()->toTimeString();
        $fichas_sintomatica->save();

        $dataSintomas = $request->dataSintomas;

        foreach ($dataSintomas as $data) {
            $detalle_sintomas = new Detalle_Sintoma();
            $detalle_sintomas->ficha_sintoma_id = $fichas_sintomatica->id;
            $detalle_sintomas->sintoma_id = $data['id'];
            $detalle_sintomas->respuesta = $data['respuesta'];
            $detalle_sintomas->save();
        }

        return response()->json([
            "res" => true,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ficha_sintomatica = FichaSintomatica::with('personas')->findOrfail($id);
        $detalle_sintomas = Detalle_Sintoma::with('sintomas')->where('ficha_sintoma_id', $id)->get();
        return response()->json([
            'res' => true,
            'ficha_sintomatica' => $ficha_sintomatica,
            'detalle_sintomas' => $detalle_sintomas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ficha = FichaSintomatica::findOrFail($id);
        $ficha->descripcion = $request->descripcion;
        $ficha->activo = $request->activo;
        $ficha->save();

        return response()->json([
            'res'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
