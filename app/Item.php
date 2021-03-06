<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
	protected $table = 'items';
	protected $primaryKey = 'id'; 
	protected $fillable = array('cantidad_unidades', 'precio_unitario', 'descripcion'); 
}
