<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Remision extends Model
{
    //
	protected $table = 'remisiones';
    protected $primaryKey   = 'id_remision';

    public function pedido()
    {
        return $this->hasOne('App\Pedido', 'id_pedido', 'id_pedido');
    }

    public function makeNumero()
    {
    	$talon = DB::table('talonarios')->select('serie_talon')->where('tipo_talon', 'REMISION')->where('id_talon', $this->attributes['id_talon'])->first();
    	return $talon->serie_talon.'-'.$this->attributes['numero_remision'];

    }
    
}
