<?php

use Illuminate\Database\Seeder;
use App\Contacto;
use Faker\Factory as Faker;

class ContactosTableSeeder extends Seeder
{
    public function run()
    {
		DB::table('contactos')->delete();
		
		for ($i=0; $i < 10; $i++) 
		{ 
			$faker = Faker::create();
			Contacto::create([
			'nombre' => $faker->firstName,
			'apellido' => $faker->lastName,
			'email' => $faker->email,
			'mensaje' => $faker->realText(rand(10,20)),
			'estate' => "No Leido"
			]);
		}
    }
}
