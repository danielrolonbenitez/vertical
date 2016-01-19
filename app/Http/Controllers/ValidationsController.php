<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App;
use Response;

class ValidationsController extends Controller
{

    public function usuarioEmail()
    {
        $email=$_GET["email"];
        $user=DB::table('users')->where('email','=',$email)->first();
       
        if ( $user )
        {
         return Response::make("404", 404);
        }
        else
            {
             return Response::make("202", 202);
            }
    }

    public function edificioCuit()
    {
        $cuit=$_GET["cuit"];
        $edificio=DB::table('edificios')->where('cuit','=',$cuit)->first();
        
        if ($edificio)
        {
        return Response::make("404", 404);
        }
        else
            {
            return Response::make("202", 202);
            }
    }

    public function edificioSuterh()
    {
        $suterh=$_GET["suterh"];
        $edificio=DB::table('edificios')->where('suterh','=',$suterh)->first();
        
        if ($edificio)
        {
        return Response::make("404", 404);
        }
        else
            {
            return Response::make("202", 202);
            }
    }

    public function administradorCuit()
    {
        $cuit=$_GET["cuit"];
        $administrador=DB::table('administradores')->where('cuit','=',$cuit)->first();
        
        if ($administrador)
        {
        return Response::make("404", 404);
        }
        else
            {
            return Response::make("202", 202);
            }
    }

    public function unidad()
    {
        $input = Input::get('edificio_id');
        $unidades = DB::table('edificios')
            ->join('pisos','edificios.id','=','pisos.edificio_id')
            ->join('unidades', 'pisos.id', '=','unidades.piso_id')
            ->where('edificio.id', '=', $input)
            ->orderBy('number', 'desc')
            ->lists('number','number');

        return Response::json($unidades);
    }
}