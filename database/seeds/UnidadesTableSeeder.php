<?php

use Illuminate\Database\Seeder;
use App\Unidad;
use Faker\Factory as Faker;

class UnidadesTableSeeder extends Seeder
{

    public function run()
    {
		//for ($i=1; $i < 10; $i++) 
		//{ 
			for ($piso=1; $piso <= 20; $piso++) 
			{
				for ($unidad=0; $unidad < 2 ; $unidad++) 
				{
					$faker = Faker::create();
					Unidad::create([
					'letra' => strtoupper($faker->unique()->randomLetter),
					'piso_id' => $piso
					]);
				}
			}
		//}
    }
}
