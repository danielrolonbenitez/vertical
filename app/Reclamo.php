<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reclamo extends Model
{
	use SoftDeletes;
	protected $table = 'reclamos';
	protected $primaryKey = 'id'; 
	protected $guarded = array('id');
	protected $fillable = array('estado', 'titulo', 'descripcion'); 
}