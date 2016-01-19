<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edificio extends Model
{
	use SoftDeletes;
	protected $table = 'edificios';
	protected $primaryKey = 'id'; 
	protected $guarded = array('id');
	protected $fillable = array('domicilio', 'razon_social', 'cuit', 'suterh'); 
}
