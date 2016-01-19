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
use App\User;
use simplePaginate;
use Hash;
use Auth;
use Session;
use Mail;

class AdminController extends Controller
{

    public function index(Request $request)
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
        $admins=DB::table('administradores')
            ->where(function($admins)
            {
                $admins->whereNULL('administradores.deleted_at');
            })
            ->where(function($admins)
            {
                $admins->where ('id','like','%'.Input::get('search').'%')
                ->orwhere ('razon_social','like','%'.Input::get('search').'%')
                ->orwhere ('cuit','like','%'.Input::get('search').'%')
                ->orwhere ('domicilio','like','%'.Input::get('search').'%');
                //->orwhere ('estado','like','%'.Input::get('search').'%')
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
        
        $admins->setPath(route('admins.index'));
        return View::make('sistema.admins.index')->with('admins', $admins);
    }

    public function create()
    {
        return View::make('sistema.admins.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email',
            'cuit' => 'required|unique:administradores,cuit',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'cp' => 'required',
            'rpa' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $admin = new Administrador;
        $admin->razon_social = Input::get('razon_social');
        $admin->cuit = Input::get('cuit');
        $admin->domicilio = Input::get('domicilio');
        $admin->cp = Input::get('cp');
        $admin->email = Input::get('admin_email');
        $admin->telefono = Input::get('telefono');
        $admin->rpa = Input::get('rpa');
        $admin->provincia = 'Buenos Aires';
        $admin->localidad = 'San Justo';
        $admin->estado = 1;
        $admin->touch();
        $admin->save();
        $user = new User;
        $user->nombre = Input::get('nombre');
        $user->apellido = Input::get('apellido');
        $user->email = Input::get('email');
        $user->rol_id = 2;
        $user->admin_id = $admin->id;
        $user->touch();
        $user->password = Hash::make(Input::get('password'));
        $user->save();
        $data = array( 'message' => 'Alta Usuario' );
        Mail::send('emails.alta_administrador', $data, function ($message) {
            $message->from('vertical@gmail.com', 'Vertica');

            $message->to(Input::get('email'));
        });
        Session::flash('alert', '1');
        return Redirect::route('admins.index');
    }

    public function show($id)
    {
        $admin=Administrador::find($id);
        if (Auth::user()->rol_id==1)
        {
            return View::make('sistema.admins.show')->with('admin',$admin);
        }
        if (Auth::user()->rol_id==2)
        {
            return View::make('administrador.dashboard')->with('admin',$admin);
        }
    }

    public function edit($id)
    {
        $admin=Administrador::find($id);
        return View::make('sistema.admins.edit')->with('admin',$admin);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'cuit' => 'required',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'estado' => 'required',
            'cp' => 'required',
            'rpa' => 'required',
        ]);
        $admin=Administrador::find($id);
        $admin->razon_social = Input::get('razon_social');
        $admin->cuit = Input::get('cuit');;
        $admin->domicilio = Input::get('domicilio');
        $admin->provincia = "Buenos Aires";
        $admin->localidad = "San Justo";
        $admin->cp = Input::get('cp');
        $admin->email = Input::get('email');
        $admin->telefono = Input::get('telefono');
        $admin->rpa = Input::get('rpa');
        $admin->estado = Input::get('estado');
        $admin->save();
        Session::flash('alert', '1');
        return Redirect::route('admins.index');
    }

    public function destroy($id)
    {
        //$admin = Administrador::find($id);
        //$admin->delete();
        Administrador::destroy($id);
        Session::flash('alert', '1');
        return Redirect::route('admins.index');
    }


}