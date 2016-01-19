<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasto extends Model
{
    use SoftDeletes;
    protected $table = 'gastos';
    protected $fillable = array('fecha', 'descripcion', 'comprobante', 'importe', 'edificio_id'); 
}
