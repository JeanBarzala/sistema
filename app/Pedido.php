<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $primaryKey   = 'id_pedido';
    protected $table = 'pedidos';


   	public function comprobante()
    {
      return $this->hasManyThrough('App\ComprobanteDetalle', 'App\Producto');
    }

    public function cliente()
    {
      return $this->belongsTo('App\Cliente', 'id_cliente', 'id_cliente');
      //return $this->belongsTo(UnidadMedida::class);
    }

    public function persona()
   	{
   		return $this->belongsTo('App\Persona', 'id_persona', 'id_persona');
   	}

    public function direccion()
    {
      return $this->belongsTo('App\Direccion', 'id_direccion_envio_pedido', 'id_direccion');
    }

    public function direccion_cobro()
    {
      return $this->belongsTo('App\Direccion', 'id_direccion_cobro_pedido', 'id_direccion');
    }

    public function comprobantes()
    {
      return $this->hasMany('App\PedidoDetalle', 'id_pedido', 'id_pedido');
    }

    public function facturas()
    {
      return $this->belongsTo('App\Factura', 'id_pedido', 'id_pedido');
    }

    public function remisiones()
    {
      return $this->belongsTo('App\Remision', 'id_pedido', 'id_pedido');
    }

    public function usuario()
    {
      return $this->belongsTo('App\User', 'id_usuario', 'id');
    }

    public function movimientos()
    {
      return $this->hasMany('App\MovimientoCaja', 'id_pedido', 'id_pedido');
    }

    public function motivo()
    {
      return $this->belongsTo('App\Motivo', 'id_motivo', 'id_motivo');
    }
    public function tarjeta()
    {
      return $this->belongsTo('App\Producto', 'id_tarjeta', 'id_producto');
    }
    
}
