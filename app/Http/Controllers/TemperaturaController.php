<?php

namespace App\Http\Controllers;

use App\Temperatura;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemperaturaController extends Controller
{
    //GET empleados
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $date = $request->date;
        $temperaturas = Temperatura::with('empleados')->buscar($buscar, $date)->orderBy('id', 'desc')->paginate(10);
        return [
            'pagination' => [
                'total'         => $temperaturas->total(),
                'current_page'  => $temperaturas->currentPage(),
                'per_page'      => $temperaturas->perPage(),
                'last_page'     => $temperaturas->lastPage(),
                'from'          => $temperaturas->firstItem(),
                'to'            => $temperaturas->lastItem(),
            ], 'temperaturas' => $temperaturas
        ];
    }

    public function show($id)
    {
        $temperatura = Temperatura::findOrFail($id)->with('empleados')->first();
        return response()->json(['temperatura' => $temperatura, 'code' => 200]);
    }

    public function store(Request $request)
    {
        $temperatura = new Temperatura();
        $temperatura->empleado_id = $request->empleado_id;
        $temperatura->temperatura = $request->temperatura;
        $temperatura->estado = $request->estado;
        $temperatura->fecha = Carbon::now()->toDateString();
        $temperatura->hora = Carbon::now()->toTimeString();
        $temperatura->save();

        return response()->json([
            'data' => $temperatura,
            'message' => 'La temperatura fue insertado correctamente',
            'code' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $temperatura = Temperatura::findOrFail($id);
        $temperatura->empleado_id = $request->empleado_id;
        $temperatura->temperatura = $request->temperatura;
        $temperatura->activo = $request->activo;
        $temperatura->update();

        return response()->json([
            'data' => $temperatura,
            'message' => 'La temperatura fue actualizada correctamente',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        Temperatura::destroy($id);
        return response()->json([
            'message' => 'La temperatura fue Eliminada correctamente',
            'code' => 200
        ]);
    }

    public function temperaturasAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $temperatura = Temperatura::findOrFail($id);
        $temperatura->activo = $newActivo;
        $temperatura->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'el estado fue cambio correctamente',
            'code' => 200
        ]);
    }
}
