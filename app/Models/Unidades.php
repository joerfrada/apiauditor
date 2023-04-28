<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Unidades extends Model
{
    protected $table = 'sg_adm_unidades';

    protected $primaryKey = 'unidad_id';

    public $timestamps = false;

    public function GetUnidades() {
        $db = DB::select('select * from sg_adm_unidades where unidad_padre_id is null order by unidad_id');
        
        return $db;
    }

    public function get_unidad_by_id(Request $request) {
        $db = DB::select('select * from sg_adm_unidades where unidad_padre_id = :id order by unidad_id', array('id' => $request->get('id')));
        
        return $db;
    }

    public function crud_unidades(Request $request, $evento) {
        if ($evento == 'C') {
            $Unidad = new Unidades();
            $Unidad->nombre_unidad = $request->get('nombre_unidad');
            $Unidad->denominacion = $request->get('denominacion');
            $Unidad->ciudad = $request->get('ciudad');
            $Unidad->direccion = $request->get('direccion');
            $Unidad->unidad_padre_id = $request->get('unidad_padre_id');
            $Unidad->activo = 1;
            $Unidad->usuario_creador = $request->get('usuario');
            $Unidad->fecha_creacion = DB::raw('GETDATE()');
            $Unidad->save();            

            return $Unidad;
        }
        else if ($evento == 'U') {
            $Unidad = Unidades::find($request->get('unidad_id'));
            $Unidad->nombre_unidad = $request->get('nombre_unidad');
            $Unidad->denominacion = $request->get('denominacion');
            $Unidad->ciudad = $request->get('ciudad');
            $Unidad->direccion = $request->get('direccion');
            $Unidad->unidad_padre_id = $request->get('unidad_padre_id');
            $Unidad->activo = $request->get('activo');
            $Unidad->usuario_modificador = $request->get('usuario');
            $Unidad->fecha_modificacion = DB::raw('GETDATE()');
            $Unidad->save(); 

            return $Unidad;
        }
    }
}
