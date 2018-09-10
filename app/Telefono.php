<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    //

    protected $table = 'telefonos';

    protected $primaryKey = 'id_telefono';


    public function ciudad()
    {
      return $this->belongsTo('App\Ciudad', 'id_ciudad', 'id_ciudad');
    }

    public function barrio()
    {
      return $this->belongsTo('App\Barrio', 'id_barrio', 'id_barrio');
    }

    public function personas() {
        return $this->belongsToMany('App\Persona', 'personas_telefonos', 'id_telefono', 'id_persona');
    }

    public function getFullTelefono()
    {
        $telefono = '';
        $tipo = '';
        $local = '';

        if ($this->tipo_telefono == 'F') {
            $tipo = 'Fijo';
        }elseif($this->tipo_telefono == 'M') {
            $tipo = 'Móvil';
        }

        if ($this->local_telefono == 'P') {
            $local = 'Particular';
        }elseif($this->local_telefono == 'L') {
            $local = 'Laboral';
        }

        $telefono = $tipo .' | ' . $local .' - '. $this->numero_telefono;

        return $telefono;
    }

}
