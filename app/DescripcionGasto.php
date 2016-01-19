<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescripcionGasto extends Model
{
	use SoftDeletes;
	protected $table = 'descripciongastos';
	protected $primaryKey = 'id'; 
	protected $fillable = array('descripcion');
}
