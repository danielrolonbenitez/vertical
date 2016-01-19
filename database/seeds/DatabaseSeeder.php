<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        //$this->call(RolTableSeeder::class);
        //$this->call(AdminTableSeeder::class);
        //$this->call(UserTableSeeder::class);
        //$this->call(EdificioTableSeeder::class);
        //$this->call(PisosTableSeeder::class);
        //$this->call(UnidadesTableSeeder::class);
        //$this->call(ContactosTableSeeder::class);
        $this->call(GastosTableSeeder::class);
        Model::reguard();
    }
}