<?php

namespace App;
use App\PedidoDetalle;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $table = 'detalles_pedidos';

    public function productos()
   	{
   		return $this->belongsTo('App\Producto', 'id_producto', 'id_producto');
   		//return $this->belongsTo(UnidadMedida::class);
   	}
}
