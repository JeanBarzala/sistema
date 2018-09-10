<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgrupadorProducto extends Model
{
    //
    protected $table = 'agrupadores_productos';

    protected $fillable = [
    	'id'
    ];

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function productos()
   	{
   		return $this->hasMany('App\Producto', 'id_producto', 'id_producto');
   	}
}
