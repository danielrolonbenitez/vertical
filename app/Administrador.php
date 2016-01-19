<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use SoftDeletes;
    protected $table = 'administradores';
    protected $fillable = ['razon_social', 'cuit','domicilio', 'cp'];
	protected $primaryKey = 'id';
	protected $guarded = array('id');
}