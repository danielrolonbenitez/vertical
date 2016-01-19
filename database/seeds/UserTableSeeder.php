<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{

    public function run()
    {
      	DB::table('users')->delete();

    	User::create([
    		'nombre' => 'Martin',
            'apellido' => 'Parrella',
    		'email' => 'parrella.martin@gmail.com',
    		'password' => Hash::make('123456'),
    		'rol_id' => 1
    	]);

        User::create([
            'nombre' => 'Ricardo',
            'apellido' => 'Conti',
            'email' => 'contibricardo@gmail.com',
            'password' => Hash::make('123456'),
            'rol_id' => 1
        ]);

        User::create([
            'nombre' => 'Daniel',
            'apellido' => 'Benitez',
            'email' => 'danielrolonbenitez@gmail.com',
            'password' => Hash::make('123456'),
            'rol_id' => 1
        ]);
        
        User::create([
            'nombre' => 'Universidad',
            'apellido' => 'Matanza',
            'email' => 'unlam@gmail.com',
            'password' => Hash::make('123456'),
            'rol_id' => 1
        ]);

        for ($user=0; $user < 10; $user++) 
        { 
            $faker = Faker::create();
            User::create([
            'nombre' => $faker->firstName($gender = null),
            'apellido' => $faker->lastName,
            'email' => $faker->email,
            'password' => Hash::make('123456'),
            'admin_id' => $user+1,
            'rol_id' => 2
            ]);
        }

        for ($user=0; $user < 10; $user++) 
        { 
            $faker = Faker::create();
            User::create([
            'nombre' => $faker->firstName($gender = null),
            'apellido' => $faker->lastName,
            'email' => $faker->email,
            'password' => Hash::make('123456'),
            'rol_id' => 3
            ]);
        }

        for ($user=0; $user < 10; $user++) 
        { 
            $faker = Faker::create();
            User::create([
            'nombre' => $faker->firstName($gender = null),
            'apellido' => $faker->lastName,
            'email' => $faker->email,
            'password' => Hash::make('123456'),
            'rol_id' => 4
            ]);
        }
    }
}