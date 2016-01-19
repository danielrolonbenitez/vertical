<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use View;

class DashboardsController extends Controller
{

    public function sistema()
    {
        return View::make('sistema.dashboard');
    }

    public function administrador()
    {
        return View::make('administrador.dashboard');
    }

    public function propietario()
    {
        return View::make('propietario.dashboard');
    }

    public function inquilino()
    {
        return View::make('inquilino.dashboard');
    }
}
