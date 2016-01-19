<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
	//use SoftDeletes;
	protected $table = 'contactos';
	protected $primaryKey = 'id'; 
	protected $fillable = array('nombre, apellido, email, mensaje'); 
}
