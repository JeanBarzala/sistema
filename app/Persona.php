<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'personas';
    protected $primaryKey   = 'id_persona';

    protected $fillable = [
      'id_estado_civil',
      'nombre_persona',
      'apellido_persona',
      'num_doc_persona',
      'tipo_doc_persona',
      'fecha_ncto_persona',
      'razon_social_persona',
      'ruc_persona',
      'email_persona',
      'sitio_web_persona',
      'sexo_persona',
      'observacion_persona',
      'fecha_registro_persona',
      'estado_persona',
      'tipo_persona'
    ];

    public function clientes()
   	{
   		return $this->belongsTo('App\Cliente', 'id_persona', 'id_persona');
   	}

   	public function usuarios()
   	{
   		return $this->belongsTo('App\User', 'id_persona', 'id_persona');
   	}

    public function personas()
    {
      return $this->belongsTo('App\Pedido', 'id_persona', 'id_persona');
    }

    public function direcciones()
    {
        return $this->hasManyThrough('App\PersonaDireccion', 'App\Persona');
    }

    public function ciudades()
    {
      return $this->belongsTo('App\Ciudad', 'id_ciudad', 'id_ciudad');
    }
    public function direccion() {
        return $this->belongsToMany('App\Direccion', 'personas_direcciones', 'id_persona', 'id_direccion');
    }

    public function telefonos() {
        return $this->belongsToMany('App\Telefono', 'personas_telefonos', 'id_persona', 'id_telefono');
    }

    public function barrios()
    {
      return $this->belongsTo('App\Barrio', 'id_barrio', 'id_persona');
    }


    public function getFullName()
    {
      $apellido = '';
      if (!empty($this->apellido_persona)) {
        $apellido = ' '. $this->apellido_persona;
      }
      
      return $this->nombre_persona.$apellido;
    }

    function getFullDireccion()
    {   
        if (!empty($this->numero_direccion)) {
            $this->numero_direccion = ' n° ' . $this->numero_direccion;
        }else {
            $this->numero_direccion = NULL;
        }
        if ($this->barrios) {
            $this->barrios->nombre_barrio = ', '. titleCase($this->barrios->nombre_barrio);
        }
        if ($this->ciudades) {
            $this->ciudades->nombre_ciudad = ' - ' . titleCase($this->ciudades->nombre_ciudad);
        }

        if (!empty($calleprincipal) AND !empty($this->interseccion1_direccion) AND !empty($interseccion2)) {
            return $calleprincipal . $this->numero_direccion .' entre '. $this->interseccion1_direccion .' y '. $interseccion2 . $this->barrios->nombre_barrio . $this->ciudades->nombre_ciudad;
        }elseif(!empty($calleprincipal) AND !empty($this->interseccion1_direccion)) {
            return $calleprincipal . ' ' . $this->numero_direccion . ' casi '. $this->interseccion1_direccion . $this->barrios->nombre_barrio . $this->ciudades->nombre_ciudad;
        }elseif (!empty($calleprincipal)) {
            return $calleprincipal . $this->numero_direccion  . $this->barrios->nombre_barrio . $this->ciudades->nombre_ciudad;
        }
    }


}
