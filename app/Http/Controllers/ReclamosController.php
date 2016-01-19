<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View;
use Input;
use App\User;
use Hash;
use Redirect;
use simplePaginate;
use Auth;
use App\Reclamo;
use App\Edificio;
use Session;
use Mail;

class ReclamosController extends Controller
{

    public function index()
    {
        if ( Input::get('sortby') && Input::get('order') )
        {    
            $sortby = Input::get('sortby');
            $order = Input::get('order');
        }
        else
        {
            $sortby = "reclamos.id";
            $order = "desc";     
        }
        
      
        $reclamos=DB::table('reclamos')
            ->join('edificios', 'reclamos.edificio_id', '=', 'edificios.id')
            ->join('roles', 'reclamos.grupo_id', '=', 'roles.id')
            ->join('unidades', 'reclamos.unidad_id', '=', 'unidades.id')
            ->join('pisos', 'pisos.id', '=', 'unidades.piso_id')
            ->where(function($reclamos)
            {
                if (Auth::user()->rol_id==2)
                {
                    $reclamos->where('edificios.admin_id','=', Auth::user()->admin_id);
                }
                if (Auth::user()->rol_id==3)
                {
                    $reclamos->join('users','users.id','=','unidades.propietario_id')
                        ->where('unidades.propietario_id','=', Auth::user()->id);
                }
                if (Auth::user()->rol_id==4)
                {
                    $reclamos->join('users','users.id','=','unidades.inquilino_id')
                        ->where('unidades.inquilino_id','=', Auth::user()->id);
                }
            })
            ->select('reclamos.id', 'edificios.razon_social', 'roles.nombre','unidades.letra', 'pisos.numero', 'reclamos.estado', 'reclamos.titulo' )   
            ->orderBy($sortby, $order)
            ->simplePaginate(10);         
        
        $reclamos->setPath(route('reclamos.index'));
        if (Auth::user()->rol_id==2)
        {
        return View::make('administrador.reclamos.index')->with('reclamos', $reclamos);
        }
        if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.reclamos.index')->with('reclamos', $reclamos);
        }
        if (Auth::user()->rol_id==4)
        {
        return View::make('inquilino.reclamos.index')->with('reclamos', $reclamos);
        }
    }

    public function create()
    {
        $edificios=DB::table('edificios')
            ->leftJoin('pisos', 'pisos.edificio_id', '=', 'edificios.id')
            ->leftJoin('unidades', 'unidades.piso_id', '=', 'pisos.id')
            //->join('edificios', 'pisos.edificio_id', '=', 'edificios.id')
            ->join('administradores', 'administradores.id', '=', 'edificios.admin_id')
            ->select('edificios.id', 'edificios.razon_social','edificios.cuit', 'edificios.suterh', 'edificios.direccion' )
            ->whereNULL('edificios.deleted_at')
            ->whereNULL('administradores.deleted_at')
            ->where(function($edificios)
            {
                if (Auth::user()->rol_id==3)
                {       
                    $edificios->where('unidades.propietario_id','=',Auth::user()->id);
                }
                if (Auth::user()->rol_id==4)
                {       
                    $edificios->where('unidades.inquilino_id','=',Auth::user()->id);
                }
            })
            ->get();

        $unidades=DB::table('unidades')
            ->leftJoin('pisos', 'pisos.id', '=', 'unidades.piso_id')
            ->select('unidades.id', 'pisos.numero', 'unidades.letra')
            ->whereNULL('unidades.deleted_at')
            //->whereNULL('administradores.deleted_at')
            ->where(function($unidades)
            {
                if (Auth::user()->rol_id==3)
                {       
                    $unidades->where('unidades.propietario_id','=',Auth::user()->id);
                }
                if (Auth::user()->rol_id==4)
                {       
                    $unidades->where('unidades.inquilino_id','=',Auth::user()->id);
                }
            })
            //->where ('unidades.id','=',Auth::user()->unidades_id)
            ->get();

        $grupos=DB::table('roles')
            ->where('id','=',2)
            ->orwhere('id','=',3)
            ->orwhere('id','=',4)
            ->get();

        if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.reclamos.create')
            ->with('edificios', $edificios)
            ->with('unidades', $unidades)
            ->with('grupos', $grupos);
            //mandar mail
        }
        if (Auth::user()->rol_id==4)
        {
        return View::make('inquilino.reclamos.create')
            ->with('edificios', $edificios)
            ->with('unidades', $unidades)
            ->with('grupos', $grupos);
            //mandar mail
        }
    }

    public function store(Request $request)
    {
            $this->validate($request, [
            'edificio_id' => 'required|exists:edificios,id',
            'grupo_id' => 'required|exists:roles,id',
            'unidad_id' => 'required|exists:unidades,id',
            'titulo' => 'required',
            'descripcion' => 'required',
            ]);
            $reclamo = new Reclamo;
            $reclamo->user_id = Auth::user()->id;
            $reclamo->edificio_id = Input::get('edificio_id');
            $reclamo->unidad_id = Input::get('unidad_id');
            $reclamo->grupo_id = Input::get('grupo_id');
            $reclamo->titulo = Input::get('titulo');
            $reclamo->descripcion = Input::get('descripcion');
            $reclamo->estado = "PENDIENTE";
            $reclamo->touch();
            $reclamo->save();
            Session::flash('alert', '1');
            return Redirect::route('reclamos.index');
    }


    public function show($id)
    {
        $reclamo=Reclamo::withTrashed()->where('id',$id)->first();

        $edificio=Edificio::find($reclamo->edificio_id);

        $usuario=User::find($reclamo->user_id);

        $unidad=DB::table('unidades')
            ->join('pisos', 'pisos.id', '=', 'unidades.piso_id')
            ->select('pisos.numero', 'unidades.letra')
            ->where('unidades.id','=',$reclamo->unidad_id)
            ->whereNULL('unidades.deleted_at')
            ->first();

        $grupos=DB::table('roles')
            ->where('id','=',2)
            ->orwhere('id','=',3)
            ->orwhere('id','=',4)
            ->get();

        $notas=DB::table('notas')
            ->join('reclamos', 'reclamos.id', '=', 'notas.reclamo_id')
            ->join('users', 'users.id', '=', 'notas.user_id')
            ->select('notas.*', 'users.nombre', 'users.apellido', 'users.email')
            ->where ('reclamos.id','=',$id)
            ->orderBy('notas.created_at', 'desc')
            ->get();      

        if (Auth::user()->rol_id==2)
        {
        return View::make('administrador.reclamos.show')
            ->with('edificio', $edificio)
            ->with('unidad', $unidad)
            ->with('grupos', $grupos)
            ->with('reclamo', $reclamo)
            ->with('usuario', $usuario)
            ->with('notas', $notas);
        }

        if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.reclamos.show')
            ->with('edificio', $edificio)
            ->with('unidad', $unidad)
            ->with('grupos', $grupos)
            ->with('reclamo', $reclamo)
            ->with('usuario', $usuario)
            ->with('notas', $notas);
        }
        if (Auth::user()->rol_id==4)
        {
        return View::make('inquilino.reclamos.show')
            ->with('edificio', $edificio)
            ->with('unidad', $unidad)
            ->with('grupos', $grupos)
            ->with('reclamo', $reclamo)
            ->with('usuario', $usuario)
            ->with('notas', $notas);
        }
    }

    public function update(Request $request, $id)
    {
            $this->validate($request, [
            'grupo_id' => 'required|exists:roles,id',
            ]);
            $reclamo = Reclamo::find($id);
            $reclamo->grupo_id = Input::get('grupo_id');
            $reclamo->save();
            //mandar mail
            Session::flash('alert', '1');
            return Redirect::route('reclamos.show', $id);
    }

    public function destroy($id)
    {
        $reclamo = Reclamo::find($id);
        $reclamo->estado="CERRADO";
        $reclamo->save();
        $reclamo->delete();
        $user = User::find($reclamo->user_id);
        Mail::send('emails.reclamo_cerrado', ['user' => $user, 'reclamo' => $reclamo], function ($message) use ($user) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Reclamo $reclamo->id');
            });
        Session::flash('alert', '1');
        return Redirect::route('reclamos.index');

    }
}
