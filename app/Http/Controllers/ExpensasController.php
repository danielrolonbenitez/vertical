<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View;
use Input;
use App\Expensa;
use App\Item;
use App\Edificio;
use App\Administrador;
use Hash;
use Redirect;
use simplePaginate;
use App\DescripcionGasto;
use Response;
use Session;
use Auth;

class ExpensasController extends Controller
{

    public function index()
    {
        $id=Input::get('id');       
        
        if ( Input::get('sortby') && Input::get('order') )
        {    
            $sortby = Input::get('sortby');
            $order = Input::get('order');
        }
        else
        {
            $sortby = "id";
            $order = "desc";     
        }    

        $expensas=DB::table('expensas')
            ->where ('edificio_id','=',$id)
            ->where(function($expensas)
            {
            $expensas->where ('id','like','%'.Input::get('search').'%')
            ->orwhere ('created_at','like','%'.Input::get('search').'%')
            ->orwhere ('vencimiento','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
        
        $expensas->setPath(route('expensas.index'));

        if (Auth::user()->rol_id==2)
        {
            return View::make('administrador.expensas.index')
                ->with('expensas', $expensas)
                ->with('edificio_id', $id);
        }
        if (Auth::user()->rol_id==3)
        {
            return View::make('propietario.expensas.index')
                ->with('expensas', $expensas)
                ->with('edificio_id', $id);
        }
        if (Auth::user()->rol_id==4)
        {
            return View::make('inquilino.expensas.index')
                ->with('expensas', $expensas)
                ->with('edificio_id', $id);
        }
    }

    public function show($id)
    {
        
        $edificio_id=Input::get('id');
        $edificio=Edificio::find($edificio_id);
        $administrador=Administrador::find($edificio->admin_id);
        $items=Item::find($id);
         
          //obtengo el id de la espensa que vien por la url//
         
        $exp_uri=$_SERVER["REQUEST_URI"];
        $exp_uri=explode('/',$exp_uri);
        $exp_uri=explode('?',$exp_uri[4]);
        $exp_id=$exp_uri[0];
        $expensa=new Expensa();
        $expensa=$expensa::find($exp_id);
            
            

        $pisos=DB::table('items')
            ->join('propietarios', 'propietarios.id', '=', 'items.unidad_id')
            ->where('items.expensa_id', '=', $id)
            ->get();

        if (Auth::user()->rol_id==2)
        {
            //return View::make('administrador.expensas.show')
            //->with('items', $items)
            //->with('edificio', $edificio)
            //->with('admin', $administrador)
            //->with('pisos', $pisos);
            
        $view =\View::make('administrador.expensas.show')
            ->with('items', $items)
            ->with('edificio', $edificio)
            ->with('admin', $administrador)
            ->with('pisos', $pisos)
             ->with('expensa', $expensa);
         $pdf =\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('Expensa.pdf');

        }
        if (Auth::user()->rol_id==3)
        {
            $view =\View::make('propietario.expensas.show')
            ->with('items', $items)
            ->with('edificio', $edificio)
            ->with('admin', $administrador)
            ->with('pisos', $pisos)
            ->with('expensa', $expensa);
             $pdf =\App::make('dompdf.wrapper');
              $pdf->loadHTML($view);
        
        return $pdf->stream('Expensa.pdf');
            //return View::make('propietario.expensas.index');
        }
        if (Auth::user()->rol_id==4)
        {
            $view =\View::make('inquilino.expensas.show')
            ->with('items', $items)
            ->with('edificio', $edificio)
            ->with('admin', $administrador)
            ->with('pisos', $pisos)
            ->with('expensa', $expensa);
             $pdf =\App::make('dompdf.wrapper');
              $pdf->loadHTML($view);
        
        return $pdf->stream('Expensa.pdf');
            //return View::make('propietario.expensas.index');
        }

    }

}
