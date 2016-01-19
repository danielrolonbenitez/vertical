<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use View;
use Input;
use App\User;
use Hash;
use Redirect;
use simplePaginate;
use App\Contacto;
use Session;

class ContactosController extends Controller
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
            $sortby = "id";
            $order = "asc";     
        }
        
        $contactos=DB::table('contactos')
            ->where ('id','like','%'.Input::get('search').'%')
            ->orwhere ('nombre','like','%'.Input::get('search').'%')
            ->orwhere ('apellido','like','%'.Input::get('search').'%')
            ->orwhere ('email','like','%'.Input::get('search').'%')
            ->orwhere ('estate','like','%'.Input::get('search').'%')
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
        $contactos->setPath(route('contactos.index'));
        return View('sistema.contactos.panel')->with('mensaje', $contactos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            
        ]);
        $contacto = new Contacto;
        $contacto->nombre = Input::get('name');
        $contacto->email = Input::get('email');
        $contacto->apellido = Input::get('subject');
        $contacto->mensaje = Input::get('message');
        $contacto->save();
        $request->session()->flash('status', 'Task was successful!');
        return View::make('index');
    }

    public function edit(Request $request)
    {    
        $id=Input::get('id');
        $task = Contacto::findOrFail($id);
        $task->estate="Leido";
        $task->save();
        return Redirect::route('contactos.index');
    }


    public function destroy($id)
    {
        Contacto::destroy($id);
        return Redirect::route('contactos.index');
    }
}


