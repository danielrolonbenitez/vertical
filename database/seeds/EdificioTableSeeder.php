<?php

use Illuminate\Database\Seeder;
use App\Edificio;
use App\Piso;
use Faker\Factory as Faker;

class EdificioTableSeeder extends Seeder
{
    public function run()
    {
		ini_set("memory_limit", "-1");
		DB::table('edificios')->delete();
		
		for ($i=0; $i < 10; $i++) 
		{ 
			$faker = Faker::create();
			
			Edificio::create([
			'razon_social' => $faker->company,
			'cuit' => $faker->randomNumber($nbDigits = 2).'-'.$faker->randomNumber($nbDigits = 8).'-'.$faker->randomNumber($nbDigits = 1),
			'suterh' => $faker->randomNumber($nbDigits = 5).'/'.$faker->randomNumber($nbDigits = 2),
			'direccion' => $faker->streetAddress,
			'admin_id' => $faker->numberBetween($min = 1, $max = 10)
			]);
		}
    }
}
