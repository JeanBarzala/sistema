<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Factura extends Model
{
    //
    protected $primaryKey   = 'id_factura';
    protected $table = 'facturas';

    public function makeNumero()
    {
    	$talon = DB::table('talonarios')->select('serie_talon')->where('tipo_talon', 'FACTURA')->where('id_talon', $this->attributes['id_talon'])->first();
    	return $talon->serie_talon.'-'.$this->attributes['numero_factura'];

    }
}
