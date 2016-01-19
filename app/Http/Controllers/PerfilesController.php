<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use View;
use Input;
use App\User;
use App\Rol;
use Hash;
use Redirect;
use simplePaginate;
use Auth;
use Session;

class PerfilesController extends Controller
{

    public function show($id)
    {
        if (Auth::user()->rol_id==1)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('sistema.perfil.show')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==2)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('administrador.perfil.show')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==3)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('propietario.perfil.show')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==4)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('inquilino.perfil.show')->with('rol',$rol->nombre);
        }
    }

    public function edit($id)
    {
        if (Auth::user()->rol_id==1)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('sistema.perfil.edit')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==2)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('administrador.perfil.edit')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==3)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('propietario.perfil.edit')->with('rol',$rol->nombre);
        }
        if (Auth::user()->rol_id==4)
        {
            $rol=Rol::find(Auth::user()->rol_id);
            return View::make('inquilino.perfil.edit')->with('rol',$rol->nombre);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'nombre' => 'required',
            'apellido' => 'required',
            ]);
        $user=User::find($id);
        if ( Input::get('email') != $user->email)
        {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email',
                ]);
        }    
        $user->nombre = Input::get('nombre');
        $user->apellido = Input::get('apellido');
        $user->email = Input::get('email');
        $user->save();
        Session::flash('alert', '1');
        return Redirect::route('perfil.show', $id);
    }

    public function destroy($id)
    {
        Auth::logout();
        User::destroy($id);
        return redirect('/home');
    }

    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
            'password1' => 'required',
            'password2' => 'required|same:password1',
            ]);

        $user=User::find($id);
        if (Auth::attempt(array('email' => $user->email, 'password' => Input::get('password'))))
        {
            $user->password = Hash::make(Input::get('password1'));
            $user->save();
            Session::flash('alert', '1');
            return Redirect::route('perfil.show', $id);
        }
        else
        {
            Session::flash('alert', '2');
            return Redirect::route('perfil.show', $id);  
        }
    }
}
