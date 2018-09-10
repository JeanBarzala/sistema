<?php

namespace App;
use App\UnidadMedida;
use App\Categoria;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos';
    protected $primaryKey   = 'id_producto';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'costo',
        'saldo_actual',
        'stock_actual',
        'stock_minimo',
        'control_stock',
        'impuesto_producto',
        'image_path',
        'estado_producto',
        'observaciones_producto',
        'etiqueta_producto',
        'es_tarjeta'
    ];

    public function medida()
   	{
   		return $this->belongsTo('App\UnidadMedida', 'unidadmedidaId', 'id');
   		//return $this->belongsTo(UnidadMedida::class);
   	}

    
    public function scopeSearch($query, $search)
    {
      if (trim($search) != "") {
        $query->where(\DB::raw("CONCAT(`nombre`)"), 'LIKE', "%$search%");
      }
      
    }

    public function categories() {

        return $this->belongsToMany('App\Agrupador', 'agrupadores_productos', 'id_producto', 'id_agrupador')->where('estado_agrupador', 1)->where('estado_agrupador_producto', 'activo');

    }
}
