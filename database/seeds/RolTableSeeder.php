<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolTableSeeder extends Seeder
{

    public function run()
    {
		DB::table('roles')->delete();

		Rol::create([
			'nombre' => 'Administrador de Sistema'
		]);

		Rol::create([
			'nombre' => 'Administrador de Consorcio'
		]);

		Rol::create([
			'nombre' => 'Propietario'
		]);

		Rol::create([
			'nombre' => 'Inquilino'
		]);
    }
}