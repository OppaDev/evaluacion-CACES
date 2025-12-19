<?php

namespace Database\Seeders;

use App\Models\Criterio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriterioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterios = [            
            ['criterio' => 'CONDICIONES INSTITUCIONALES'],
            ['criterio' => 'DOCENCIA'],
            ['criterio' => 'CONDICIONES DEL PERSONAL ACADÉMICO, APOYO ACADÉMICO Y ESTUDIANTES'],
            ['criterio' => 'INVESTIGACIÓN E INNOVACIÓN'],
            ['criterio' => 'VINCULACIÓN CON LA SOCIEDAD'],
            ['criterio' => 'SISTEMA DE GESTIÓN DE LA CALIDAD'],

        ];

        foreach ($criterios as $criterio) {
            Criterio::create($criterio);
        }
    }
}
