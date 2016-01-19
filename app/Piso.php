<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piso extends Model
{
	use SoftDeletes;
	protected $table = 'pisos';
	protected $primaryKey = 'id'; 
	protected $fillable = array('numero'); 
}