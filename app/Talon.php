<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talon extends Model
{
    //

    protected $table = 'talonarios';
    protected $primaryKey   = 'id_talon';

    public function bocas_facturacion()
    {
        return $this->hasOne('App\Boca', 'id_talon', 'id_talon');
    }
}
