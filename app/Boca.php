<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boca extends Model
{
    //
	protected $primaryKey = 'id_boca_facturacion';
    protected $table = 'bocas_facturacion';

    public function talonario() {
        return $this->belongsTo('App\Talon', 'id_talon', 'id_talon');
    }
}
