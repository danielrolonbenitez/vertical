<?php

namespace App\Http\Controllers;
use DB;
use View;
use Input;
use Redirect;
use Request;
use App\Role;

class RolesController extends Controller
{

    public function index()
    {
        $roles=DB::table('roles')
                    ->whereNULL('roles.deleted_at')
                    ->get();
        return View::make('roles.index')->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $name = Input::get('e_name');
        $role=Role::find($id);
        $role->nombre = $name;
        $role->save();
        return Redirect::route('roles.index');
    }

}