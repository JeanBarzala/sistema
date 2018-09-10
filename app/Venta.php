<?php

namespace App;
use App\Cliente;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'comprobantes';


   	public function comprobante()
    {
        return $this->hasManyThrough('App\ComprobanteDetalle', 'App\Producto');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }


    

   	
}
