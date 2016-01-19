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
use App\Edificio;
use Hash;
use Redirect;
use simplePaginate;
use Calendar;
use App\Evento;
use Auth;
use Session;
use App\Amenitie;
use App\Rol;



class EventosController extends Controller
{   
  public function index()
  {
    $uri=$_SERVER["REQUEST_URI"];
    Session::put('uri',$uri);
    Session::put('edificio_id', Input::get('id'));
    Session::put('aut',Auth::id());
    $eventos=DB::table('eventos')
    ->whereNULL('eventos.deleted_at')
    ->where('edificio_id', '=', Input::get('id'))
    ->get();
    $miseventos=DB::table('eventos')
    ->whereNULL('eventos.deleted_at')
    ->where('user_id', '=', Auth::user()->id)
    ->where('inicio','>=', date('Y-m-d', time()))
    ->where('edificio_id', '=', Input::get('id'))
    ->orderBy('inicio', 'asc')
    ->simplePaginate(5);
    $miseventos->setPath(route('eventos.index', ['id' => Session::get('edificio_id') ]));
    if (Auth::user()->rol_id==2)
    {
      return View::make('administrador.eventos.index')
        ->with('eventos', $eventos)
        ->with('miseventos', $miseventos);
    }
    if (Auth::user()->rol_id==3)
    {
      return View::make('propietario.eventos.index')
        ->with('eventos', $eventos)
        ->with('miseventos', $miseventos);
    }
    if (Auth::user()->rol_id==4)
    {
      return View::make('inquilino.eventos.index')
        ->with('eventos', $eventos)
        ->with('miseventos', $miseventos);
    }
  }

  public function regresaIdEdificio()
  {
    $uri= Session::get('uri');
    $uri=explode('=',$uri);  
    $id=$uri[1];
    return $id;
  }

  public function create()
  {
    $id=self::regresaIdEdificio();
    $amenities=DB::table('amenities')
    ->whereNULL('amenities.deleted_at')
    ->where('edificio_id', $id)
    ->get();  
    if (Auth::user()->rol_id==2)
    {
      return View::make('administrador.eventos.create')
        ->with('amenities',$amenities)
        ->with('edificio_id', $id);
    }  
    if (Auth::user()->rol_id==3)
    {
      return View::make('propietario.eventos.create')
        ->with('amenities',$amenities)
        ->with('edificio_id', $id);
    }
    if (Auth::user()->rol_id==4)
    {
      return View::make('inquilino.eventos.create')
        ->with('amenities',$amenities)
        ->with('edificio_id', $id);
    }
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'inicio' => 'required',
      'fin' => 'required',
      'titulo' => 'required',
      ]);
    $evento = new Evento;
    $evento->inicio = Input::get('inicio');
    $evento->fin = Input::get('fin');
    $evento->titulo = Input::get('titulo');
    if ( Input::get('descripcion') !== NULL)
    {
      $evento->descripcion = Input::get('descripcion');
    }
    $evento->edificio_id = Session::get('edificio_id');
    if ( Input::get('amenitie_id') != 999 )
    {
      $evento->amenitie_id= Input::get('amenitie_id');
    }
    $evento->user_id=Auth::id();
    $evento->touch();
    $evento->save();
    if ( isset($_POST['notificar']) )
    {
      $users=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->join('users', 'users.id', '=', 'unidades.propietario_id')
            ->where('pisos.edificio_id', '=', Session::get('edificio_id'))
            ->distinct()
            ->get();
      $edificio=Edificio::find(Session::get('edificio_id'));
      $de=User::find(Auth::user()->id);
        foreach ($users as $user) 
        {
          Mail::send('emails.evento', ['de' => $de, 'user' => $user, 'evento' => $evento], function ($message) use ($user, $edificio) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Evento Consorcio - '.$edificio->razon_social);
            });
        }
        $users=DB::table('pisos')
            ->join('unidades', 'unidades.piso_id', '=', 'pisos.id')
            ->join('users', 'users.id', '=', 'unidades.inquilino_id')
            ->where('pisos.edificio_id', '=', Session::get('edificio_id'))
            ->distinct()
            ->get();
        foreach ($users as $user) 
        {
          Mail::send('emails.evento', ['de' => $de, 'user' => $user, 'evento' => $evento], function ($message) use ($user, $edificio) 
            {
            $message->from('vertical@gmail.com', 'Vertical');
            $message->sender('vertical@gmail.com', 'Vertical');
            $message->to( $user->email );
            $message->subject('Evento Consorcio - '.$edificio->razon_social);
            });
        }
        Session::flash('alert', '1');
    }
    return Redirect::route('eventos.index', ['id' => Session::get('edificio_id') ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'inicio' => 'required',
      'fin' => 'required',
      'titulo' => 'required',
      ]);
    $evento=Evento::find($id);
    $evento->inicio = Input::get('inicio');
    $evento->fin = Input::get('fin');
    $evento->titulo = Input::get('titulo');
    if ( Input::get('descripcion') !== NULL)
    {
      $evento->descripcion = Input::get('descripcion');
    }
    $evento->edificio_id = Session::get('edificio_id');
    if ( Input::get('amenitie_id') != 999 )
    {
      $evento->amenitie_id= Input::get('amenitie_id');
    }
    else
    {
      $evento->amenitie_id=null;
    }
    $evento->save();
    return Redirect::route('eventos.index', ['id' => Session::get('edificio_id') ]);
  }

  public function destroy($id)
  {
    $evento=Evento::find($id);
    $evento->forceDelete();
    Session::flash('alert', '1');
    return Redirect::route('eventos.index', [ 'id' => Session::get('edificio_id')]);
  }

  public function alleventjson()
  {
    $id=Session::get('edificio_id');
    $eventos=DB::table('eventos')->where('edificio_id', '=', $id)->get();
    $actual_id=Auth::id();

    foreach ($eventos as $evento) 
    {
      $user_id=$evento->user_id;
      $user=new User();
      $user=$user::find($user_id);
      $rol_id=$user->rol_id;

      
if($user_id==$actual_id)
{
  $color="#08065f";
}else{
      switch ($rol_id) {
                        case 1:
                          $color="red";
                          break;
                        case 2:
                          $color="orange";
                          break;

                          case 3:
                          $color="yellow";
                          break;

                          case 4:
                          $color="green";
                          break;



                        default:
                           $color="#08065f";
                          break;
                        }
    }//endelse



      $miArray[]=array('id'=>$evento->id,
        'title' => $evento->titulo,
        "color"=> $color,
        "start"=>$evento->inicio,
        "end"=>$evento->fin,
        "descripcion"=>$evento->descripcion);
    }
    return  $miArray;
  }

  public function show($id)
  {
    $evento=Evento::find($id);
    $amenitie=Amenitie::find($evento->amenitie_id);
    $user=User::find($evento->user_id);
    if (Auth::user()->rol_id==2)
    {
      return view('administrador.eventos.show')
        ->with("evento", $evento)
        ->with("user", $user)
        ->with("amenitie",$amenitie);
    }
    if (Auth::user()->rol_id==3)
    {
      return view('propietario.eventos.show')
        ->with("evento", $evento)
        ->with("user", $user)
        ->with("amenitie",$amenitie);
    }
    if (Auth::user()->rol_id==4)
    {
      return view('inquilino.eventos.show')
        ->with("evento", $evento)
        ->with("user", $user)
        ->with("amenitie",$amenitie);
    }
  }

  public function edit($id)
  {
    $evento=Evento::find($id);
    $amenities=DB::table('amenities')
    ->whereNULL('amenities.deleted_at')
    ->where('edificio_id', $evento->edificio_id)
    ->get();
    if (Auth::user()->rol_id==2)
    {
      return View::make('administrador.eventos..edit')
        ->with('evento',$evento)
        ->with('amenities',$amenities);
    }
    if (Auth::user()->rol_id==3)
    {
      return View::make('propietario.eventos..edit')
        ->with('evento',$evento)
        ->with('amenities',$amenities);
    }
    if (Auth::user()->rol_id==4)
    {
      return View::make('inquilino.eventos..edit')
        ->with('evento',$evento)
        ->with('amenities',$amenities);
    }
  }
}
