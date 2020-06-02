<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'UserController@login');
Route::get('getTipo_usuario', 'TipoUsuarioController@getTipo_usuario');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'UserController@logout');

    Route::apiResource('condiciones', 'CondicionController');
    Route::get('getCondiciones', 'CondicionController@getCondiciones');
    Route::put('condicionesAD/{id}/{activo}', 'CondicionController@condicionesAD');

    Route::apiResource('empleados', 'EmpleadoController');
    Route::get('getEmpleados', 'EmpleadoController@getEmpleados');
    Route::put('empleadosAD/{id}/{activo}', 'EmpleadoController@empleadosAD');

    Route::apiResource('temperaturas', 'TemperaturaController');
    Route::put('temperaturasAD/{id}/{activo}', 'TemperaturaController@temperaturasAD');

    Route::apiResource('tipo_usuarios', 'TipoUsuarioController');
    Route::put('tipo_usuariosAD/{id}/{activo}', 'TipoUsuarioController@tipo_usuariosAD');

    Route::apiResource('users', 'UserController');
    Route::put('usersAD/{id}/{activo}', 'UserController@usersAD');
});
