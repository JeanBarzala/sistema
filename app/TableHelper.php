<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableHelper extends Model
{
    //
    protected $table = 'helper';

    protected $fillable = [
    	'id'
    ];

    protected $fillable = [
        'model', 'value'
    ];

    public function lastId ($model)
    {
    	return DB::table('helper')->max($model);
    }

    /*public function productos()
   	{
   		return $this->hasMany('App\Producto', 'id_producto', 'id_producto');
   	}*/
}
