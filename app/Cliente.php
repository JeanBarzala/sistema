<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Venta;

class Cliente extends Model
{
    //
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $perPage = 8;

    protected $fillable = [
    	'id_tipo_cliente',
    	'id_persona',
    	'contribuyente_cliente',
    	'calificacion_cliente',
    	'credito_cliente'
    ];

    public function persona()
   	{
   		return $this->hasOne('App\Persona', 'id_persona', 'id_persona');
   	}
	
}
