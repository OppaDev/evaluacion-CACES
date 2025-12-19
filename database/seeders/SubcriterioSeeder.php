<?php

namespace Database\Seeders;

use App\Models\Subcriterio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcriterioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcriterios = [            
            ['cri_id' => '1', 'subcriterio' => 'SUBCRITERIO 1: GESTIÓN ESTRATÉGICA'],
            ['cri_id' => '1', 'subcriterio' => 'SUBCRITERIO 2: INFRAESTRUCTURA'],
            ['cri_id' => '1', 'subcriterio' => 'SUBCRITERIO 3: PRINCIPIOS Y VALORES'],
            ['cri_id' => '3', 'subcriterio' => 'SUBCRITERIO 4: PERSONAL ACADÉMICO Y PERSONAL DE APOYO'],
            ['cri_id' => '3', 'subcriterio' => 'SUBCRITERIO 5: ASPIRANTES, ESTUDIANTES Y GRADUADOS'],
            ['cri_id' => '4', 'subcriterio' => 'SUBCRITERIO 6: POLÍTICA DE INVESTIGACIÓN Y ORGANIZACIÓN'],
            ['cri_id' => '4', 'subcriterio' => 'SUBCRITERIO 7: RESULTADOS, CONTRIBUCIÓN E IMPACTOS DE LA INVESTIGACIÓN,DESARROLLO E INNOVACIÓN'],
        ];

        foreach ($subcriterios as $subcriterio) {
            Subcriterio::create($subcriterio);
        }
    }
}
