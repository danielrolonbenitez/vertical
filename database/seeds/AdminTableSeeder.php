<?php

use Illuminate\Database\Seeder;
use App\Administrador;
use Faker\Factory as Faker;
use App\DescripcionGasto;

class AdminTableSeeder extends Seeder
{

    public function run()
    {
		DB::table('administradores')->delete();
		
		for ($admin=0; $admin < 10; $admin++) 
		{ 
			$faker = Faker::create();
			Administrador::create([
			'razon_social' => $faker->company,
			'cuit' => $faker->unique()->randomNumber($nbDigits = 8),
			'domicilio' => $faker->streetAddress,
			'localidad' => "San Justo",
			'provincia' => "Buenos Aires",
			'email' => $faker->email,
			'telefono' => $faker->phoneNumber,
			'situacion_fiscal' => "Responsable Inscripto",
			'rpa' => $faker->unique()->randomNumber($nbDigits = 4),
			'cp' => $faker->randomNumber($nbDigits = 4),
			'estado' => 1
			]);

			DescripcionGasto::create([
			'descripcion' => "Alumbrado Barrido y Limpieza (ABL)",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Edenor Medidor",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Metrogas",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Gastos Bancarios",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Gastos Administradtivos",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Mantenimiento Asensor",
			'admin_id' => $admin+1
			]);

			DescripcionGasto::create([
			'descripcion' => "Mantenimiento Matafuegos",
			'admin_id' => $admin+1
			]);
		}
	
    }
}