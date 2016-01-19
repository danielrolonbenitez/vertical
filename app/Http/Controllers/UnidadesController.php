<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;
use Input;
use Redirect;
use App\Edificio;
use App\User;
use App\Unidad;
use Auth;
use Hash;
use Session;
use Mail;

class UnidadesController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'piso_id' => 'required',
            'letra' => 'required',
            'porcentaje' => 'required',
            'metros' => 'required',
        ]); 
        $unidad = new Unidad;
        $unidad->piso_id = Input::get('piso_id');
        $unidad->letra = Input::get('letra');
        $unidad->metros = Input::get('metros');
        $unidad->porcentaje = Input::get('porcentaje');
        $unidad->touch();
        $unidad->save();
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#unidades']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'piso_id_e' => 'required',
            'letra_e' => 'required',
            'porcentaje_e' => 'required',
            'metros_e' => 'required',
        ]);
        $unidad=Unidad::find($id);
        $unidad->piso_id = Input::get('piso_id_e');
        $unidad->letra = Input::get('letra_e');
        $unidad->metros = Input::get('metros_e');
        $unidad->porcentaje = Input::get('porcentaje_e');
        $unidad->save();
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#unidades']);
    }

    public function destroy($id)
    {
        Unidad::destroy($id);
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#unidades']);
    }

    public function propietarios($id)
    {
        if ( Input::get('sortby') && Input::get('order') )
        {    
            $sortby = Input::get('sortby');
            $order = Input::get('order');
        }
        else
        {
            $sortby = "id";
            $order = "asc";     
        }
        
        $users=DB::table('users')
            ->whereNULL('users.deleted_at')
            ->join('roles', 'users.rol_id', '=', 'roles.id')
            ->select('users.*','roles.nombre AS rol', 'roles.id AS rol_id')
            ->where(function($users)
            {
                    $users->where ('rol_id','=',3);
            })
            ->where(function($users)
            {
            $users->where ('users.nombre','like','%'.Input::get('search').'%')
            ->orwhere ('apellido','like','%'.Input::get('search').'%')
            ->orwhere ('email','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);         
        
        $users->setPath(route('unidad.propietarios.show', $id));
        if (Auth::user()->rol_id==1)
        { 
        return View::make('sistema.edificios.propietarios')
        ->with('users', $users)
        ->with('unidad_id', $id);
        }
        if (Auth::user()->rol_id==2)
        { 
        return View::make('administrador.edificios.propietarios')
        ->with('users', $users)
        ->with('unidad_id', $id);
        }        
    }

    public function updatepropietario($id)
    {
        $propietario_id = Input::get('propietario_id');
        $unidad=Unidad::find($id);  
        $unidad->propietario_id=$propietario_id;
        $unidad->save();
        $piso=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->distinct()
            ->first();
        $edificio=Edificio::find(Session::get('edificio_id'));
        $user=User::find($propietario_id);
        Mail::send('emails.propietario', ['edificio' => $edificio, 'piso' => $piso, 'user' => $user, 'unidad' => $unidad], function ($message) use ($user, $edificio) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Actualización Perfil - '.$edificio->razon_social);
            });
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#unidades']);
    }

    public function inquilinos($id)
    {
        if ( Input::get('sortby') && Input::get('order') )
        {    
            $sortby = Input::get('sortby');
            $order = Input::get('order');
        }
        else
        {
            $sortby = "id";
            $order = "asc";     
        }       
      
        $users=DB::table('users')
            ->whereNULL('users.deleted_at')
            ->join('roles', 'users.rol_id', '=', 'roles.id')
            //->leftJoin('unidades', 'unidades.inquilino_id', '=', 'users.id')
            //->where('inquilino_id', '=', NULL)
            ->select('users.*','roles.nombre AS rol', 'roles.id AS rol_id')
            ->where(function($users)
            {
                    $users->where ('rol_id','=',4);
            })
            ->where(function($users)
            {
            $users->where ('users.nombre','like','%'.Input::get('search').'%')
            ->orwhere ('apellido','like','%'.Input::get('search').'%')
            ->orwhere ('email','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);         
        
        $users->setPath(route('unidad.inquilinos.show', $id));
        if (Auth::user()->rol_id==1)
        { 
        return View::make('sistema.edificios.inquilinos')
        ->with('users', $users)
        ->with('unidad_id', $id);
        }
        if (Auth::user()->rol_id==2)
        { 
        return View::make('administrador.edificios.inquilinos')
        ->with('users', $users)
        ->with('unidad_id', $id);
        } 
        if (Auth::user()->rol_id==3)
        { 
        return View::make('propietario.edificios.inquilinos')
        ->with('users', $users)
        ->with('unidad_id', $id);
        } 
    }

    public function updateinquilino($id)
    {
        $unidad=Unidad::find($id); 
        $inquilino_id = Input::get('inquilino_id');
        $unidad->inquilino_id=$inquilino_id;
        if (Input::get('inquilino_id')=="null")
        {
            $unidad->inquilino_id=null;
        }        
        $unidad->save();
        if (Input::get('inquilino_id')!="null")
        {
        $piso=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->distinct()
            ->first();
        $edificio=Edificio::find(Session::get('edificio_id'));
        $user=User::find($inquilino_id);
        Mail::send('emails.inquilino', ['edificio' => $edificio, 'piso' => $piso, 'user' => $user, 'unidad' => $unidad], function ($message) use ($user, $edificio) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Actualización Perfil - '.$edificio->razon_social);
            });
        }
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#unidades']);
    }

}