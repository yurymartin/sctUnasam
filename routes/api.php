<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('declaracion', 'JuramentacionController@declaracion');
Route::post('login', 'UserController@login');
Route::get('getTipo_usuario', 'TipoUsuarioController@getTipo_usuario');
Route::get('getCondiciones', 'CondicionController@getCondiciones');
Route::get('verificar', 'PersonaController@verificar');

// Route::group(['middleware' => 'auth:api'], function () {

Route::post('logout', 'UserController@logout');

Route::apiResource('condiciones', 'CondicionController');
Route::put('condicionesAD/{id}/{activo}', 'CondicionController@condicionesAD');

Route::apiResource('sintomas', 'SintomaController');
Route::get('getSintomas', 'SintomaController@getSintomas');
Route::put('sintomasAD/{id}/{activo}', 'SintomaController@sintomasAD');

Route::apiResource('personas', 'PersonaController');
Route::get('getPersonas', 'PersonaController@getPersonas');
Route::put('personasAD/{id}/{activo}', 'PersonaController@personasAD');

Route::apiResource('temperaturas', 'TemperaturaController');
Route::get('getTemperaturas/{id}', 'TemperaturaController@getTemperaturas');
Route::put('temperaturasAD/{id}/{activo}', 'TemperaturaController@temperaturasAD');

Route::apiResource('tipo_usuarios', 'TipoUsuarioController');
Route::put('tipo_usuariosAD/{id}/{activo}', 'TipoUsuarioController@tipo_usuariosAD');

Route::apiResource('organos', 'OrganoController');
Route::get('getOrganos', 'OrganoController@getOrganos');
Route::put('organosAD/{id}/{activo}', 'OrganoController@organosAD');

Route::post('juramentacion', 'JuramentacionController@store');
Route::get('verifyDocumento/{id}', 'JuramentacionController@verifyDocumento');

Route::apiResource('unidades_organicas', 'UnidadesOrganicasController');
Route::get('getUnidades_Organicas', 'UnidadesOrganicasController@getUnidades_Organicas');
Route::put('unidades_organicasAD/{id}/{activo}', 'UnidadesOrganicasController@unidades_organicasAD');

Route::apiResource('users', 'UserController');
Route::put('usersAD/{id}/{activo}', 'UserController@usersAD');

Route::apiResource('fichassintomaticas', 'FichaSintomaticaController');
Route::get('getFichas', 'FichaSintomaticaController@getFichas');

Route::apiResource('horarios_medico', 'HorarioMedicoController');
Route::get('getHorarios/{id}', 'HorarioMedicoController@getHorarios');

Route::apiResource('doctores', 'DoctoresController');

// });

Route::get('allEmpleados', 'ReporteController@allEmpleados');
Route::get('allEmpleadosCondicion', 'ReporteController@allEmpleadosCondicion');
