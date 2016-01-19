<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use Redirect;
use Mail;
use \App\User;
use Request;
use Session;
use DB;
use View;

class SessionsController extends Controller
{
    public function store()
    {
        $email = Request::input('email');
        $password = Request::input('password');
        
        if (Auth::attempt(array('email' => $email, 'password' => $password)))
        {            
            if (Auth::user()->rol_id==1)
            {
                return Redirect::route('sistema.dashboard');
            }            
            if (Auth::user()->rol_id==2)
            {
                return Redirect::route('administrador.dashboard');
            }            
            if (Auth::user()->rol_id==3)
            {
                return Redirect::route('propietarios.dashboard');
            }    
            if (Auth::user()->rol_id==4)
            {
                return Redirect::route('inquilinos.dashboard');
            }
        }
        else
        {
            return View::make('index')
            ->with('message', 'Credenciales inválidas!');
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}