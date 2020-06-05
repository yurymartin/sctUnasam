<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Tipo_Usuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $users = User::with('personas')->with('tipo_usuarios')->buscar($buscar)->orderBy('id', 'desc')->paginate(10);
        return [
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ], 'users' => $users
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'persona_id' => 'required|unique:users,persona_id',
            'tipo_usuario_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $newUser = new User();
        $newUser->persona_id = $request->persona_id;
        $newUser->tipo_usuario_id = $request->tipo_usuario_id;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->save();

        return response()->json([
            'data' => $newUser,
            'message' => 'El usuario fue insertado Exitosamente',
            'code' => 200
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
        //
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
        // $this->validate($request, [
        //     'persona_id' => 'required|unique:users,persona_id,' . $id,
        //     'tipo_usuario_id' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email,' . $id,
        //     'password' => 'required',
        // ]);
        $newUser = User::findOrFail($id);
        if ($request->has('password')) {
            $newUser->persona_id = $request->persona_id;
            $newUser->tipo_usuario_id = $request->tipo_usuario_id;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->password = bcrypt($request->password);
            $newUser->save();
        } else {
            $newUser->persona_id = $request->persona_id;
            $newUser->tipo_usuario_id = $request->tipo_usuario_id;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->save();
        }
        return response()->json([
            'data' => $newUser,
            'message' => 'El usuario fue actualizado Exitosamente',
            'code' => 200
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
        User::destroy($id);
        return response()->json([
            'message' => 'el tipo de usuario fue eliminado correctamente',
            'code' => 200
        ]);
    }


    public function usersAD(Request $request, $id, $activo)
    {
        $newActivo = !($request->activo);
        $user = User::findOrFail($id);
        $user->activo = $newActivo;
        $user->update();

        return response()->json([
            'activo' => $activo,
            'newActivo' => $newActivo,
            'message' => 'Cambio el estado correctamentea',
            'code' => 200
        ]);
    }

    public function login()
    {
        $data = [
            'email' => request('email'),
            'password' => request('password'),
            'tipo_usuario_id' => request('tipo_usuario_id')
        ];

        if (Auth::attempt($data)) {
            $tipo_usuario = Tipo_Usuario::findOrFail($data['tipo_usuario_id']);
            $user = Auth::user();
            $persona = Persona::findOrFail($user->persona_id);
            $token['token'] = $user->createToken('token')->accessToken;
            return response()->json([
                'res' => true,
                'type' => 'Bearer',
                "token" => $token,
                "tipo_usuario" => $tipo_usuario,
                "persona" => $persona,
                "message" => "Bienvenido al sistema SCT-UNASAM",
                "code" => 200
            ]);
        } else {
            return response()->json([
                'res' => false,
                "message" => "Error en el login",
                "code" => 401
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Session Cerrada Exitosamente'
        ]);
    }
}
