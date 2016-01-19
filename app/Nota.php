<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
	use SoftDeletes;
	protected $table = 'notas';
	protected $primaryKey = 'id'; 
	//protected $fillable = array('cantidad_unidades', 'precio_unitario', 'descripcion'); 
}
