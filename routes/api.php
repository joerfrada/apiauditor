<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Param\CriterioController;
use App\Http\Controllers\Param\ListaController;
use App\Http\Controllers\Param\ProcesoController;
use App\Http\Controllers\Param\TipoAuditoriaController;
use App\Http\Controllers\Unidad\UnidadController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [LoginController::class, 'login']);
Route::any('logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'admin'], function() {
    Route::get('usuarios', [UserController::class, 'getUsers']);
    Route::post('usuario/crearUsuario', [UserController::class, 'crearUsuario']);
    Route::post('usuario/actualizarUsuario', [UserController::class, 'actualizarUsuario']);
    Route::post('usuario/crearUsuarioRol', [UserController::class, 'crearUsuarioRol']);
    Route::post('usuario/actualizarUsuarioRol', [UserController::class, 'actualizarUsuarioRol']);
    Route::post('usuario/getUsuariosRolesById', [UserController::class, 'getUsuariosRolesById']);
    Route::post('usuario/eliminarUsuariosRolesId', [UserController::class, 'eliminarUsuariosRolesId']);
    Route::post('usuario/asignarMenu', [UserController::class, 'crearAsignarMenu']);
    Route::get('usuario/getRolPrivilegiosPantalla', [UserController::class, 'getRolPrivilegiosPantalla']);
    Route::get('usuario/personales_activos', [UserController::class, 'getPersonalesActivos']);

    Route::get('roles', [RolController::class, 'getRoles']);
    Route::post('rol/crearRol', [RolController::class, 'crearRol']);
    Route::post('rol/actualizarRol', [RolController::class, 'actualizarRol']);
    Route::get('rol/getRolesActivos', [RolController::class, 'getRolesActivos']);
    Route::get('rol/getModulos', [RolController::class, 'getModulos']);
    Route::post('rol/crearRolPrivilegios', [RolController::class, 'crearRolPrivilegios']);
    Route::post('rol/actualizarRolPrivilegios', [RolController::class, 'actualizarRolPrivilegios']);
    Route::post('rol/getRolPrivilegiosById', [RolController::class, 'getRolPrivilegiosById']);
    Route::post('rol/eliminarRolPrivilegiosById', [RolController::class, 'eliminarRolPrivilegiosById']);
});

Route::group(['prefix' => 'param'], function() {
    Route::get('criterios', [CriterioController::class, 'getCriterios']);
    Route::get('procesos', [ProcesoController::class, 'getProcesos']);
    Route::get('tipoauditoria', [TipoAuditoriaController::class, 'getTipoAuditorias']);

    Route::get('listas', [ListaController::class,'getListas']);
    Route::post('lista/crearLista', [ListaController::class, 'crearLista']);
    Route::post('lista/actualizarLista', [ListaController::class, 'actualizarLista']);
    Route::post('lista/getListasById', [ListaController::class, 'getListasId']);
    Route::post('lista/crearListaDetalle', [ListaController::class, 'crearListaDetalle']);
    Route::post('lista/actualizarListaDetalle', [ListaController::class, 'actualizarListaDetalle']);
});

Route::group(['prefix' => 'unidad'], function() {
    Route::get('empresas_activos', [UnidadController::class, 'getEmpresasActivos']);
});
