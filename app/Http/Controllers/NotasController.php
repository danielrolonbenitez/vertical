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
use App\Nota;
use Session;

class NotasController extends Controller
{

    public function store(Request $request)
    {
            $this->validate($request, [
            'nota' => 'required',
            'reclamo_id' => 'required|exists:reclamos,id',
            ]);
            $nota = new Nota;
            $nota->texto = Input::get('nota');
            $nota->reclamo_id = Input::get('reclamo_id');
            $nota->user_id = Auth::user()->id;
            $nota->touch();
            $nota->save();
            Session::flash('alert', '1');
            return Redirect::route('reclamos.show', Input::get('reclamo_id'));
    }

}
