<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use View;
use Input;
use Redirect;
use App\Amenitie;
use Session;

class AmenitiesController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required',
        ]);
        $amenitie = new Amenitie;
        $amenitie->descripcion = Input::get('descripcion');
        $amenitie->edificio_id = Session::get('edificio_id');
        $amenitie->touch();
        $amenitie->save();
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#amenities']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'descripcion_e' => 'required',
        ]);
        $amenitie=Amenitie::find($id);
        $amenitie->descripcion = Input::get('descripcion_e');
        $amenitie->save();
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#amenities']);
    }

    public function destroy($id)
    {
        Amenitie::destroy($id);
        return Redirect::route('edificios.show', ['id' => Session::get('edificio_id'), '#amenities']);
    }
}
