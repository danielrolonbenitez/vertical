<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenitie extends Model
{
	use SoftDeletes;
	protected $table = 'amenities';
	protected $primaryKey = 'id'; 
	protected $fillable = array('descripcion'); 
}
