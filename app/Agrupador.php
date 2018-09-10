<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agrupador extends Model
{
    //
    protected $table = 'agrupadores';
    protected $primaryKey   = 'id_agrupador';

    protected $fillable = [
    	'nombre_agrupador',
    	'descripcion_agrupador',
    	'portada_agrupador',
    	'orden_agrupador',
    	'estado_agrupador'
    ];

    public function productos() {
        return $this->belongsToMany('App\Producto', 'agrupadores_productos', 'id_agrupador', 'id_producto');
    }
    
}
