<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'sg_adm_nombres_listas';

    protected $primaryKey = 'nombre_lista_id';

    public $timestamps = false;

    public function crud_listas(Request $request, $evento) {
        if ($evento == 'C') {
            $Listas = new Lista;
            $Listas->nombre_lista = $request->get('nombre_lista');
            $Listas->activo = 1;
            $Listas->usuario_creador = $request->get('usuario');
            $Listas->fecha_creacion = \DB::raw('GETDATE()');
            $Listas->save();            

            return $Listas;
        }
        else if ($evento == 'U') {
            $Listas = Lista::find($request->get('nombre_lista_id'));
            $Listas->nombre_lista = $request->get('nombre_lista');
            $Listas->activo = $request->get('activo') == true ? 1 : 0;
            $Listas->usuario_modificador = $request->get('usuario');
            $Listas->fecha_modificacion = \DB::raw('GETDATE()');
            $Listas->save(); 

            return $Listas;
        }
    }
}
