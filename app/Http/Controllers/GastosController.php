<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View;
use Input;
use App\Gasto;
use Hash;
use Redirect;
use simplePaginate;
use App\DescripcionGasto;
use Response;
use Session;
use Auth;

class GastosController extends Controller
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
            $sortby = "fecha";
            $order = "desc";     
        }    
        $gastos=DB::table('gastos')
            ->whereNULL('deleted_at')
            ->where('edificio_id','=', $id)
            ->where(function($gastos)
            {
            $gastos->where ('id','like','%'.Input::get('search').'%')
                ->orwhere ('fecha','like','%'.Input::get('search').'%')
                ->orwhere ('descripcion','like','%'.Input::get('search').'%')
                ->orwhere ('comprobante','like','%'.Input::get('search').'%')
                ->orwhere ('importe','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);  
        $gastos->setPath(route('gastos.index'));
        if (Auth::user()->rol_id==2)
        {
        return View::make('administrador.gastos.index')
            ->with('gastos', $gastos)
            ->with('edificio_id', $id);
        }
        if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.gastos.index')
            ->with('gastos', $gastos)
            ->with('edificio_id', $id);
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'edificio_id' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'importe' => 'required',
            'comprobante' => 'required',
        ]); 
        $descripcion = new DescripcionGasto;
        $descripcion->descripcion = Input::get('descripcion');
        $descripcion->admin_id = Auth::user()->admin_id;
        $descripcion->touch();
        $descripcion->save();

        $gasto = new Gasto;
        $gasto->fecha = Input::get('fecha');
        $gasto->descripcion = Input::get('descripcion');
        $gasto->importe = Input::get('importe');
        $gasto->comprobante = Input::get('comprobante');
        $gasto->edificio_id = Input::get('edificio_id');
        $gasto->touch();
        $gasto->save();
        Session::flash('alert', '1');
        return Redirect::route('gastos.index', ['id' => Input::get('edificio_id')]);
    }

    public function edit($id)
    {
        $gasto=Gasto::find($id);
        return View::make('administrador.gastos.edit')
            ->with('gasto', $gasto)
            ->with('edificio_id', $gasto->edificio_id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'edificio_id' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'importe' => 'required',
            'comprobante' => 'required',
        ]);
        $gasto=Gasto::find($id);
        $gasto->fecha = Input::get('fecha');
        $gasto->descripcion = Input::get('descripcion');
        $gasto->importe = Input::get('importe');
        $gasto->comprobante = Input::get('comprobante');
        $gasto->edificio_id = Input::get('edificio_id');
        $gasto->save();
        Session::flash('alert', '1');
        return Redirect::route('gastos.index', ['id' => Input::get('edificio_id')]);
        
    }

    public function create()
    {
        return View::make('administrador.gastos.create')->with('edificio_id',Input::get('id'));
    }

    public function destroy($id)
    {
        Gasto::destroy($id);
        Session::flash('alert', '1');
        return Redirect::route('gastos.index', ['id' => Input::get('edificio_id')]);
    }

    public function test()
    {
        $term = Input::get('term');
        $results = array();
        $descripciones=DB::table('descripciongastos')
            ->where('admin_id','=',Auth::user()->admin_id)
            ->where('descripcion','like','%'.$term.'%')
            ->get();
            foreach ($descripciones as $descripcion)
    {
        $results[] = [ 'id' => $descripcion->id, 'value' => $descripcion->descripcion ];
    }
        return Response::json($results);
        //return $descripciones->toJson();
        //return View::make('administrador.gastos.create');
        //return Response::json(array('descripciones'=>$descripciones));
    }
}
