<?php

namespace App\Http\Controllers;

use App\Horario_Medico;
use Illuminate\Http\Request;

class HorarioMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $date = $request->date;
        $horario_medico = Horario_Medico::with('users')->with('status_horario')->orderBy('id', 'desc')
            ->paginate(20);
        return response()->json([
            'pagination' => [
                'total'         => $horario_medico->total(),
                'current_page'  => $horario_medico->currentPage(),
                'per_page'      => $horario_medico->perPage(),
                'last_page'     => $horario_medico->lastPage(),
                'from'          => $horario_medico->firstItem(),
                'to'            => $horario_medico->lastItem(),
            ], 'horario_medico' => $horario_medico,
            'code' => 200
        ]);
    }

    public function getHorarios($id)
    {
        $Horario_Medico = Horario_Medico::where('medico_id', '=', $id)->with('status_horario')->get();
        return response()->json([
            'Horario_Medico' => $Horario_Medico
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $buscar = $request->buscar;
        // $date = $request->date;
        // $Horario_Medico = Horario_Medico::findOrFail($id);
        // return response()->json(['Horario_Medico' => $Horario_Medico, 'code' => 200]);
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
        //
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
