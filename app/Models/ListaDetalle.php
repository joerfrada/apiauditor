<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ListaDetalle extends Model
{
    use HasFactory;

    protected $table = 'sg_adm_listas_dinamicas';

    protected $primaryKey = 'lista_dinamica_id';

    public $timestamps = false;

    public function get_lista_by_id(Request $request) {
        $db = \DB::select('select * from sg_adm_listas_dinamicas where nombre_lista_id = :id order by lista_dinamica_id', array('id' => $request->get('nombre_lista_id')));
        
        return $db;
    }

    public function crud_listas_detalles(Request $request, $evento) {
        if ($evento == 'C') {
            $Listas = new ListaDetalle;
            $Listas->nombre_lista_id = $request->get('nombre_lista_id');
            $Listas->lista_dinamica = $request->get('lista_dinamica');
            $Listas->lista_padre_id = $request->get('lista_padre_id');
            $Listas->activo = 1;
            $Listas->usuario_creador = $request->get('usuario');
            $Listas->fecha_creacion = \DB::raw('GETDATE()');
            $Listas->save();            

            return $Listas;
        }
        else if ($evento == 'U') {
            $Listas = ListaDetalle::find($request->get('lista_dinamica_id'));
            $Listas->nombre_lista_id = $request->get('nombre_lista_id');
            $Listas->lista_dinamica = $request->get('lista_dinamica');
            $Listas->lista_padre_id = $request->get('lista_padre_id');
            $Listas->activo = $request->get('activo') == true ? 1 : 0;
            $Listas->usuario_modificador = $request->get('usuario');
            $Listas->fecha_modificacion = \DB::raw('GETDATE()');
            $Listas->save(); 

            return $Listas;
        }
    }
}
