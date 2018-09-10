<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaDireccion extends Model
{
    //
    protected $table = 'personas_direcciones';

    protected $fillable =   ['id_direccion', 'id_persona'];

    public function direcciones()
   	{
   		return $this->belongsTo('App\Direccion', 'id_direccion');
   	}

   	public function ciudades()
    {
      return $this->belongsTo('App\Ciudad', 'id_direccion', 'id_ciudad');
    }

}
