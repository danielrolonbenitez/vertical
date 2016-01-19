<?php

use Illuminate\Database\Seeder;
use App\Piso;
use App\Unidad;
use App\Amenitie;
use Faker\Factory as Faker;

class PisosTableSeeder extends Seeder
{
    public function run()
    {
		ini_set("memory_limit", "-1");
		$count=1;
		for ($edificio=0; $edificio < 10; $edificio++) 
		{ 
			for ($piso=1; $piso < 3; $piso++) 
			{
				Piso::create([
				'numero' => $piso,
				'edificio_id' => $edificio+1
				]);
				for ($unidad=0; $unidad < 2 ; $unidad++) 
				{
					$faker = Faker::create();
					Unidad::create([
					'letra' => strtoupper($faker->unique()->randomLetter),
					'metros' => 40,
					'porcentaje' => 25,
					'propietario_id' => $faker->numberBetween($min = 15, $max = 25),
					'inquilino_id' => $faker->numberBetween($min = 25, $max = 34),
					'piso_id' => $count
					]);
				}
				$count++;
			}

			Amenitie::create([
			'descripcion' => "Gimnasio",
			'edificio_id' => $edificio+1
			]);

			Amenitie::create([
			'descripcion' => "SUM",
			'edificio_id' => $edificio+1
			]);

			Amenitie::create([
			'descripcion' => "Lavadero",
			'edificio_id' => $edificio+1
			]);
		
		}
    }
}