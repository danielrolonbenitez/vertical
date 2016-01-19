<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
	protected $table = 'facturas';
	protected $primaryKey = 'id'; 
	protected $fillable = array('fecha', 'vencimiento', 'total', 'estado' ); 
}