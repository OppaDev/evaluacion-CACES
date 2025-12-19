<?php

namespace Database\Seeders;

use App\Models\Escala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escalas =[
            [
                'escala' => "SATISFACTORIO",
                'porcentaje' => 100,
            ],
            [
                'escala' => "CUASI SATISFACTORIO",
                'porcentaje' => 70,
            ],
            [
                'escala' => "POCO SATISFACTORIO",
                'porcentaje' => 35,
            ],
            [
                'escala' => "DEFICIENTE",
                'porcentaje' => 0,
            ],
        ];

        foreach ($escalas as $escala) {
            Escala::create($escala);
        }

    }
}
