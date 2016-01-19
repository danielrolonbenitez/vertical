<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;
use Input;
use Redirect;
use App\Administrador;
use simplePaginate;
use App\Edificio;
use App\Piso;
use App\User;
use Auth;
use Session;
use Mail;

class EdificiosController extends Controller
{

    public function index()
    {

        $sortby = "id";
        $order = "asc"; 

        if ( Input::get('sortby') && Input::get('order') )
        {    
            $sortby = Input::get('sortby');
            $order = Input::get('order');
        }

        $edificios=DB::table('edificios')
            ->leftJoin('pisos', 'pisos.edificio_id', '=', 'edificios.id')
            ->leftJoin('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->join('administradores', 'administradores.id', '=', 'edificios.admin_id')
            ->select('edificios.id', 'edificios.razon_social','edificios.cuit', 'edificios.suterh', 'edificios.direccion' )
            ->distinct()
            ->whereNULL('edificios.deleted_at')
            ->whereNULL('administradores.deleted_at')
            ->where(function($edificios)
            {
                if (Auth::user()->rol_id==2)
                {
                    $edificios->where ('edificios.admin_id','=',Auth::user()->admin_id);
                }
               if (Auth::user()->rol_id==3)
                {
                    $edificios->where ('unidades.propietario_id','=',Auth::user()->id);
                }
               if (Auth::user()->rol_id==4)
                {
                    $edificios->where ('unidades.inquilino_id','=',Auth::user()->id);
                }
            })
            ->where(function($edificios)
            {
                $edificios->where ('edificios.id','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.razon_social','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.cuit','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.suterh','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.direccion','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);

        $edificios->setPath(route('edificios.index'));
        
        if (Auth::user()->rol_id==1)
        {
            return View::make('sistema.edificios.index')->with('edificios', $edificios);
        }
        if (Auth::user()->rol_id==2)
        {    
            return View::make('administrador.edificios.index')->with('edificios', $edificios);
        }
        if (Auth::user()->rol_id==3)
        {    
            return View::make('propietario.edificios.index')->with('edificios', $edificios);
        }
        if (Auth::user()->rol_id==4)
        {    
            return View::make('inquilino.edificios.index')->with('edificios', $edificios);
        }
    }

    public function create()
    {
        if (Auth::user()->rol_id==1)
        { 
        $admins=DB::table('administradores')
        ->whereNULL('administradores.deleted_at')
        ->get();
        return View::make('sistema.edificios.create')->with('admins',$admins);
        }
        if (Auth::user()->rol_id==2)
        { 
        $admins=Administrador::find(Auth::user()->admin_id);
        return View::make('administrador.edificios.create')->with('admins',$admins);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cuit' => 'required',
            'razon_social' => 'required',
            'direccion' => 'required',
            'suterh' => 'required',
            'admin_id' => 'required',
            'pisos' => 'required',
        ]);
        $edificio = new Edificio;
        $edificio->razon_social = Input::get('razon_social');
        $edificio->cuit = Input::get('cuit');;
        $edificio->direccion = Input::get('direccion');
        $edificio->suterh = Input::get('suterh');
        $edificio->admin_id = Input::get('admin_id');
        $edificio->touch();
        $edificio->save();
        $cantidad= Input::get('pisos');
        for ($floor=1; $floor <= $cantidad; $floor++) {
                $piso= new Piso; 
                $piso->numero = $floor;
                $piso->edificio_id=$edificio->id;
                $piso->touch();
                $piso->save();
        }
        Session::flash('alert', '1');
        return Redirect::route('edificios.index');
    }

    public function show($id)
    {
        Session::put('edificio_id', $id);

        $edificio=Edificio::find($id);

        $porcentaje=DB::table('propietarios')
        ->where('edificio_id', '=', $id)
        ->sum('porcentaje');

        Session::flash('alert', '5');
        if ( strcmp($porcentaje,"100") != 0 )
        {
            Session::flash('alert', '0');
            //return strcmp($porcentaje,"100");
        }

        /*$pisos=DB::table('unidades')
            ->join('pisos', 'unidades.piso_id', '=', 'pisos.id')
            ->leftJoin('users', 'unidades.propietario_id', '=', 'users.id')
            ->select('pisos.numero', 'users.nombre', 'users.apellido', 'unidades.id', 'unidades.letra', 'unidades.porcentaje', 'unidades.metros')
            ->where('edificio_id', '=', $id)
            ->get();*/
        $pisos=DB::table('propietarios')
            ->leftJoin('users', 'users.id', '=', 'propietarios.inquilino_id')
            ->select('propietarios.*', 'users.nombre', 'users.apellido')
            ->whereNULL('propietarios.deleted_at')
            ->where('propietarios.edificio_id', '=', $id)
            ->get();
        
        $piso=DB::table('pisos')
            ->where('edificio_id', '=', $id)
            ->get();

        $amenities=DB::table('amenities')
            ->whereNULL('amenities.deleted_at')
            ->where('edificio_id', '=', $id)
            ->get();
        $admin=Administrador::find($edificio->admin_id);
       
        if (Auth::user()->rol_id==1)
        {        
        return View::make('sistema.edificios.show') ->with('edificio', $edificio)
                                            ->with('piso', $piso)
                                            ->with('pisos', $pisos)
                                            ->with('admin', $admin)
                                            ->with('amenities', $amenities);
        }

        if (Auth::user()->rol_id==2)
        {        
        return View::make('administrador.edificios.show') ->with('edificio', $edificio)
                                            ->with('piso', $piso)
                                            ->with('pisos', $pisos)
                                            ->with('admin', $admin)
                                            ->with('amenities', $amenities);
        }
        if (Auth::user()->rol_id==3)
        {        
        return View::make('propietario.edificios.show') ->with('edificio', $edificio)
                                            ->with('piso', $piso)
                                            ->with('pisos', $pisos)
                                            ->with('admin', $admin)
                                            ->with('amenities', $amenities);
        }
        if (Auth::user()->rol_id==4)
        {        
        return View::make('inquilino.edificios.show') ->with('edificio', $edificio)
                                            ->with('piso', $piso)
                                            ->with('pisos', $pisos)
                                            ->with('admin', $admin)
                                            ->with('amenities', $amenities);
        }
    }

    public function edit($id)
    {
        $edificio=Edificio::find($id);
        $pisos=DB::table('unidades')
            ->join('pisos', 'unidades.piso_id', '=', 'pisos.id')
            ->where('edificio_id', '=', $id)
            ->get();
        $piso=DB::table('pisos')
            ->where('edificio_id', '=', $id)
            ->get();
        $admin=Administrador::find($edificio->admin_id);
        $admins=DB::table('administradores')
        ->whereNULL('administradores.deleted_at')
        ->get();
        $edificio=Edificio::find($id);
        if (Auth::user()->rol_id==1)
        { 
            return View::make('sistema.edificios.edit')->with('edificio', $edificio)->with('piso', $piso)->with('pisos', $pisos)->with('admin', $admin)->with('admins',$admins);
        }
        if (Auth::user()->rol_id==2)
        { 
            return View::make('administrador.edificios.edit')->with('edificio', $edificio)->with('piso', $piso)->with('pisos', $pisos)->with('admin', $admin);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cuit' => 'required',
            'razon_social' => 'required',
            'direccion' => 'required',
            'suterh' => 'required',
            'admin_id' => 'required',
        ]);
        $edificio=Edificio::find($id);
        $edificio->razon_social = Input::get('razon_social');
        $edificio->cuit = Input::get('cuit');;
        $edificio->direccion = Input::get('direccion');
        $edificio->suterh = Input::get('suterh');
        $edificio->admin_id = Input::get('admin_id');
        $edificio->save();
        Session::flash('alert', '1');
        return Redirect::route('edificios.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $admin = Edificio::find($id);
        $admin->delete();
        //Administrador::destroy($id);
        Session::flash('alert', '1');
        return Redirect::route('edificios.index');
    }

    public function message($id)
    {
        $users=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->join('users', 'users.id', '=', 'unidades.propietario_id')
            ->where('pisos.edificio_id', '=', $id)
            ->distinct()
            ->get();
        $edificio=Edificio::find($id);
        $de=User::find(Auth::user()->id);
        $mensaje=Input::get('message');
        foreach ($users as $user) 
        {
            Mail::send('emails.notificacion', ['de' => $de, 'user' => $user, 'mensaje' => $mensaje], function ($message) use ($user, $edificio) {
                $message->from('vertical@gmail.com', 'Vertical');
                $message->to( $user->email );
                $message->subject('Notificación Consorcio - '.$edificio->razon_social);
            });
        }
        $users=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->join('users', 'users.id', '=', 'unidades.inquilino_id')
            ->where('pisos.edificio_id', '=', $id)
            ->distinct()
            ->get();
        foreach ($users as $user) 
        {
            Mail::send('emails.notificacion', ['de' => $de, 'user' => $user, 'mensaje' => $mensaje], function ($message) use ($user, $edificio) {
                $message->from('vertical@gmail.com', 'Vertical');
                $message->to( $user->email );
                $message->subject('Notificación Consorcio - '.$edificio->razon_social);
            });
        }
        Session::flash('alert', '1');
        return Redirect::route('edificios.index');
    }

}