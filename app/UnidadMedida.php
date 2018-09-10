<?php

namespace App;
use App\Material;
use App\Producto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UnidadMedida extends Model
{
    //

    protected $table = 'unidadmedida';

   


    public function materiales ()
   	{
   		return $this->hasMany('App\Producto');
   	}




}
