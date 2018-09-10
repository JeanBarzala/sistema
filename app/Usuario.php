<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'users';
    protected $perPage = 8;


    public function persona()
   	{
   		return $this->belongsTo('App\Persona', 'id_persona', 'id_persona');
   	}

	
}
