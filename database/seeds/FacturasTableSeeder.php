<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Factura;
use Faker\Factory as Faker;

class FacturasTableSeeder extends Seeder
{

    public function run()
    {
		DB::table('facturas')->delete();
		$faker = Faker::create();
		for ($admin=1; $admin<11; $admin++) 
		{
			for ($factura=1; $factura<6; $factura++) 
			{
				Factura::create([
				'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
				'total' => 150,
				'vencimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
				'estado' => "PAGA",
				'administrador_id' => $admin
				]);
				for ($item=0; $item<2; $item++)
				{
					Item::create([
					'cantidad' => 3,
					'precio' => 5,
					'descripcion' => "Descripcion",
					'factura_id' => $factura
					]);
				}
			}
		}
    }
}
