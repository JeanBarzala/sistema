<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //

    protected $table = 'direcciones';

    protected $primaryKey = 'id_direccion';


    public function ciudades()
    {
      return $this->belongsTo('App\Ciudad', 'id_ciudad', 'id_ciudad');
    }

    public function barrios()
    {
      return $this->belongsTo('App\Barrio', 'id_barrio', 'id_barrio');
    }

    public function personas() {
        return $this->belongsToMany('App\Persona', 'personas_direcciones', 'id_direccion', 'id_persona');
    }

    function getFullDireccion()
    {   
        $direccion = '-';
        $barrio = '';
        $ciudad = '';
        if ($this->numero_direccion) {
            $numeracion = ' n° ' . $this->numero_direccion;
        }else {
            $numeracion = NULL;
        }
        if ($this->barrios) {
            $barrio = ', '. titleCase($this->barrios->nombre_barrio);
        }
        if ($this->ciudades) {
            $ciudad = ' - ' . titleCase($this->ciudades->nombre_ciudad);
        }

        if (!empty($this->calle_direccion) AND !empty($this->interseccion1_direccion) AND !empty($this->interseccion2)) {
            $direccion = $this->calle_direccion . $numeracion .' entre '. $this->interseccion1_direccion .' y '. $this->interseccion2 . $barrio . $ciudad;
        }elseif(!empty($this->calle_direccion) AND !empty($this->interseccion1_direccion)) {
            $direccion = $this->calle_direccion . ' ' . $numeracion . ' casi '. $this->interseccion1_direccion . $barrio . $ciudad;
        }elseif (!empty($this->calle_direccion)) {
            $direccion = $this->calle_direccion . $numeracion  . $barrio . $ciudad;
        }
        return $direccion;
    }



}
