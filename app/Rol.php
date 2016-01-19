<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
	use SoftDeletes;
	protected $table = 'roles';
	protected $primaryKey = 'id'; 
	protected $guarded = array('id');
	protected $fillable = array('nombre'); 
}