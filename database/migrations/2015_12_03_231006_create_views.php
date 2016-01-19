<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViews extends Migration
{

    public function up()
    {
        DB::statement(" 
            CREATE VIEW propietarios AS
                SELECT 
                    pisos.edificio_id AS edificio_id,
                    pisos.numero AS numero,
                    unidades.piso_id AS piso_id,
                    unidades.letra AS letra,
                    unidades.porcentaje AS porcentaje,
                    unidades.metros AS metros,
                    unidades.id AS id,
                    unidades.inquilino_id AS inquilino_id,
                    CONCAT_WS(' ',
                            users.nombre,
                            users.apellido) AS propietario
                FROM
                    ((unidades
                    LEFT JOIN users ON ((users.id = unidades.propietario_id)))
                    JOIN pisos ON ((pisos.id = unidades.piso_id))) 
        ");

        DB::statement(" 
            CREATE VIEW inquilinos AS
                SELECT 
                    unidades.id AS id,
                    CONCAT_WS(' ',
                            users.nombre,
                            users.apellido) AS inquilino
                FROM
                    (users
                    JOIN unidades ON ((unidades.inquilino_id = users.id)))
        ");
    }


    public function down()
    {
        DB::statement('DROP VIEW propietarios');
        DB::statement('DROP VIEW inquilinos');
    }
}
