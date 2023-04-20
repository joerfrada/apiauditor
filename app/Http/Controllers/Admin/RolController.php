<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rol;
use App\Models\RolPrivilegio;

class RolController extends Controller
{
    public function getRoles() {    
        $datos = \DB::select("select * from roles order by id");

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getRolesActivos() {
       $datos = \DB::select("select * from roles where activo = 1");

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearRol(Request $request) {
        $m = new Rol;
        $rol = $m->crud_roles($request, 'C');
        if ($rol->id != 0) {
            $response = json_encode(array('mensaje' => 'Ha creado exitosamente.', 'tipo' => 0, 'id' => $rol->id), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    public function actualizarRol(Request $request) {
        $m = new Rol;
        $rol = $m->crud_roles($request, 'U');
        if ($rol) {
            $response = json_encode(array('mensaje' => 'Ha actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    public function getModulos() {
        $model = new RolPrivilegio;

        $datos = $model->get_modulos();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getRolPrivilegiosById(Request $request) {
        $model = new RolPrivilegio;

        $datos = $model->get_roles_privilegios_by_rol_id($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearRolPrivilegios(Request $request) {
        $model = new RolPrivilegio;

        $db = $model->crud_roles_privilegios($request, 'C');

        if ($db->rol_privilegio_id != 0) {
            $id = $db->rol_privilegio_id;

            $response = json_encode(array('mensaje' => 'Fue creado exitosamente.', 'tipo' => 0, 'id' => $id), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response, 200);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    public function actualizarRolPrivilegios(Request $request) {
        $model = new RolPrivilegio;

        $db = $model->crud_roles_privilegios($request, 'C');

        if ($db) {            
            $response = json_encode(array('mensaje' => 'Fue actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response, 200);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    public function eliminarRolPrivilegiosById(Request $request) {
        $model = new RolPrivilegio;

        try {
            $db = $model->eliminar_roles_privilegios_by_id($request);

            if ($db) {
                $response = json_encode(array('mensaje' => 'Fue eliminado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }
}
