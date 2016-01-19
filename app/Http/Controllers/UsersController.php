<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use View;
use Input;
use App\User;
use App\Administrador;
use App\Rol;
use Hash;
use Redirect;
use simplePaginate;
use Auth;
use Session;

class UsersController extends Controller
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
        
        $roles=DB::table('roles')
                    ->get();
        
        if (Auth::user()->rol_id==1)
        { 
            $users=DB::table('users')
            ->join('roles', 'users.rol_id', '=', 'roles.id')
            ->select('users.id', 'users.nombre', 'users.apellido', 'users.email', 'roles.nombre as rol')
            ->where(function($users)
            {
                $users->whereNULL('users.deleted_at');
            })
            ->where(function($users)
            {
            $users->where ('users.nombre','like','%'.Input::get('search').'%')
            ->orwhere ('users.id','like','%'.Input::get('search').'%')
            ->orwhere ('apellido','like','%'.Input::get('search').'%')
            ->orwhere ('email','like','%'.Input::get('search').'%')
            ->orwhere ('roles.nombre','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
            $users->setPath(route('users.index'));
            return View::make('sistema.users.index')->with('users', $users)->with('roles', $roles);
        }
        
        if (Auth::user()->rol_id==2)
        { 
            $users=DB::table('users')
            ->leftJoin('unidades as u1', 'users.id', '=', 'u1.propietario_id')
            ->leftJoin('unidades as u2', 'users.id', '=', 'u2.inquilino_id')
            ->leftJoin('pisos as p1', 'u1.piso_id', '=', 'p1.id')
            ->leftJoin('pisos as p2', 'u2.piso_id', '=', 'p2.id')
            ->leftJoin('edificios as e1', 'p1.edificio_id', '=', 'e1.id')
            ->leftJoin('edificios as e2', 'p2.edificio_id', '=', 'e2.id')
            ->select('users.id', 'users.nombre', 'users.apellido', 'users.email', 'roles.nombre as rol')
            ->join('roles', 'users.rol_id', '=', 'roles.id')
            ->where(function($users)
            {
                $users->whereNULL('users.deleted_at');
            })
            ->where(function($users)
            {
                $users->where ('e1.admin_id','=',Auth::user()->admin_id)
                    ->orwhere ('e2.admin_id','=',Auth::user()->admin_id)
                    ->orwhere ('users.admin_id','=',Auth::user()->admin_id);
            })
            ->where(function($users)
            {
                $users->where ('users.nombre','like','%'.Input::get('search').'%')
                    ->orwhere ('users.id','like','%'.Input::get('search').'%')
                    ->orwhere ('apellido','like','%'.Input::get('search').'%')
                    ->orwhere ('email','like','%'.Input::get('search').'%')
                    ->orwhere ('roles.nombre','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->groupBy('users.id')
            ->simplePaginate(10);
            $users->setPath(route('users.index'));
            return View::make('administrador.users.index')->with('users', $users)->with('roles', $roles);
        }
        
        if (Auth::user()->rol_id==3)
        { 
            $users=DB::table('users')
            ->join('roles', 'users.rol_id', '=', 'roles.id')
            ->leftJoin('unidades', 'users.id', '=', 'unidades.inquilino_id')
            ->leftJoin('pisos', 'unidades.piso_id', '=', 'pisos.id')
            ->leftJoin('edificios', 'pisos.edificio_id', '=', 'edificios.id')
            ->join('administradores', 'administradores.id', '=', 'edificios.admin_id')
            ->select('users.*','roles.nombre AS rol', 'roles.id AS rol_id')
            ->whereNULL('administradores.deleted_at')
            ->whereNULL('users.deleted_at')
            ->whereNULL('edificios.deleted_at')
            ->where(function($users)
            {
                $users->where ('unidades.propietario_id','=',Auth::user()->id);
            })
            ->where(function($users)
            {
                $users->where ('users.nombre','like','%'.Input::get('search').'%')
                ->orwhere ('users.id','like','%'.Input::get('search').'%')
                ->orwhere ('apellido','like','%'.Input::get('search').'%')
                ->orwhere ('users.email','like','%'.Input::get('search').'%')
                ->orwhere ('roles.nombre','like','%'.Input::get('search').'%');
            })
            ->distinct()
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
            $users->setPath(route('users.index'));
            return View::make('propietario.users.index')->with('users', $users)->with('roles', $roles);
        }
    }

    public function create()
    {
        if (Auth::user()->rol_id==1)
        { 
            $roles=DB::table('roles')
                    ->where('id','=',1)
                    ->orwhere('id','=',3)
                    ->orwhere('id','=',4)
                    ->get();
            return View::make('sistema.users.create')->with('roles', $roles);
        }
        if (Auth::user()->rol_id==2)
        { 
            $roles=DB::table('roles')
                    ->where('id','=',2)
                    ->orwhere('id','=',3)
                    ->orwhere('id','=',4)
                    ->get();
            $administrador=Administrador::find(Auth::user()->admin_id);
            return View::make('administrador.users.create')->with('roles', $roles)->with('administrador', $administrador);
        }
        if (Auth::user()->rol_id==3)
        { 
            $roles=DB::table('roles')
                    ->orwhere('id','=',4)
                    ->get();
            $administrador=Administrador::find(Auth::user()->admin_id);
            return View::make('propietario.users.create')->with('roles', $roles)->with('administrador', $administrador);;
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->rol_id==1)
        {
            $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'rol_id' => 'required|exists:roles,id',
            ]);
            $user = new User;
            $user->nombre = Input::get('nombre');
            $user->apellido = Input::get('apellido');
            $user->email = Input::get('email');
            $user->rol_id = Input::get('rol_id');
            $user->touch();
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            $rol=Rol::find(Input::get('rol_id'));
            Mail::send('emails.usuario', ['user' => $user, 'rol' => $rol, 'pass' => Input::get('password') ], function ($message) use ($user) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Vertical - Creación de Cuenta');
            });
            Session::flash('alert', '1');
            return Redirect::route('users.index');
        }
        if (Auth::user()->rol_id==2)
        {
            $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'rol_id' => 'required|exists:roles,id',
            ]);         
            $user = new User;
            $user->nombre = Input::get('nombre');
            $user->apellido = Input::get('apellido');
            $user->email = Input::get('email');
            $user->rol_id = Input::get('rol_id');
            if ( Input::get('rol_id') == 2)
            {
                $user->admin_id = Auth::user()->admin_id;
            }
            $user->touch();
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            $rol=Rol::find(Input::get('rol_id'));
            Mail::send('emails.usuario', ['user' => $user, 'rol' => $rol, 'pass' => Input::get('password') ], function ($message) use ($user) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Vertical - Creación de Cuenta');
            });
            Session::flash('alert', '1');
            return Redirect::route('users.index');
        }
        if (Auth::user()->rol_id==3)
        {
            $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'rol_id' => 'required|exists:roles,id',
            ]);         
            $user = new User;
            $user->nombre = Input::get('nombre');
            $user->apellido = Input::get('apellido');
            $user->email = Input::get('email');
            $user->rol_id = Input::get('rol_id');
            $user->touch();
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            $rol=Rol::find(Input::get('rol_id'));
            Mail::send('emails.usuario', ['user' => $user, 'rol' => $rol, 'pass' => Input::get('password') ], function ($message) use ($user) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Vertical - Creación de Cuenta');
            });
            Session::flash('alert', '1');
            return Redirect::route('users.index');
        }
    }

    private $a;

    public function show($id)
    {
        $this->a = $id;
        $usuario=User::find($id);
        $rol=Rol::find($usuario->rol_id);
        $admin=Administrador::find($usuario->admin_id);

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
            ->select('edificios.id', 'edificios.razon_social','edificios.cuit', 'edificios.suterh', 'edificios.direccion' )
            ->distinct()
            ->where(function($edificios)
            {
                $edificios->whereNULL('edificios.deleted_at');
            })
            ->where(function($edificios)
            {
                //->whereNULL('edificios.deleted_at')
                $edificios->where ('unidades.propietario_id','=',$this->a)
                ->orwhere ('unidades.inquilino_id','=',$this->a);
            })
            ->where(function($edificios)
            {
                $edificios->where ('edificios.id','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.razon_social','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.direccion','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.cuit','like','%'.Input::get('search').'%')
                    ->orwhere ('edificios.suterh','like','%'.Input::get('search').'%');
            })
            ->orderBy($sortby, $order)
            ->simplePaginate(10);
        if (Auth::user()->rol_id==1)
        {
        return View::make('sistema.users.show')
        ->with('usuario',$usuario)
        ->with('rol',$rol)
        ->with('edificios', $edificios)
        ->with('admin',$admin);
        }
      if (Auth::user()->rol_id==2)
        {
        return View::make('administrador.users.show')
        ->with('usuario',$usuario)
        ->with('rol',$rol)
        ->with('edificios', $edificios)
        ->with('admin',$admin);
        }
      if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.users.show')
        ->with('usuario',$usuario)
        ->with('rol',$rol)
        ->with('edificios', $edificios)
        ->with('admin',$admin);
        }
    }

    public function edit($id)
    {
        $usuario=User::find($id);
        $rol=Rol::find($usuario->rol_id);
        if (Auth::user()->rol_id==1)
        {
        return View::make('sistema.users.edit')->with('usuario',$usuario)->with('rol',$rol);
        }
        if (Auth::user()->rol_id==2)
        {
        return View::make('administrador.users.edit')->with('usuario',$usuario)->with('rol',$rol);
        }
        if (Auth::user()->rol_id==3)
        {
        return View::make('propietario.users.edit')->with('usuario',$usuario)->with('rol',$rol);
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
        return Redirect::route('users.index');
    }

    public function updatepass(Request $request, $id)
    {
        $this->validate($request, [
            'password1' => 'required',
            'password2' => 'required|same:password1',
        ]);
        $user=User::find($id);
        $user->password = Hash::make(Input::get('password1'));
        $user->save();
        return Redirect::route('users.index');
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        //User::destroy($id);
        $usuario->delete();
        Session::flash('alert', '1');
        return Redirect::route('users.index');
    }

}