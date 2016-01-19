<?php

use Illuminate\Database\Seeder;
use App\Gasto;
use Faker\Factory as Faker;

class GastosTableSeeder extends Seeder
{
    public function run()
    {
		for ($i=1; $i < 15; $i++) 
		{ 
			$faker = Faker::create();
			Gasto::create([
			'fecha' => '2015-11-01',
			'descripcion' => 'Gastos Bancarios',
			'comprobante' => 'Factura A',
			'importe' => 200,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-11-02',
			'descripcion' => 'Alumbrado Barrido y Limpieza (ABL)',
			'comprobante' => 'Factura A',
			'importe' => 250,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-11-03',
			'descripcion' => 'Edenor Medidor',
			'comprobante' => 'Factura A',
			'importe' => 300,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-11-04',
			'descripcion' => 'Gastos Administrativos',
			'comprobante' => 'Factura A',
			'importe' => 225,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-11-05',
			'descripcion' => 'Metrogas',
			'comprobante' => 'Factura A',
			'importe' => 325,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-12-01',
			'descripcion' => 'Gastos Bancarios',
			'comprobante' => 'Factura A',
			'importe' => 200,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-12-02',
			'descripcion' => 'Alumbrado Barrido y Limpieza (ABL)',
			'comprobante' => 'Factura A',
			'importe' => 250,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-12-03',
			'descripcion' => 'Edenor Medidor',
			'comprobante' => 'Factura A',
			'importe' => 300,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-12-04',
			'descripcion' => 'Gastos Administrativos',
			'comprobante' => 'Factura A',
			'importe' => 225,
			'edificio_id' => $i
			]);
			Gasto::create([
			'fecha' => '2015-12-05',
			'descripcion' => 'Metrogas',
			'comprobante' => 'Factura A',
			'importe' => 325,
			'edificio_id' => $i
			]);
		}
    }
}
