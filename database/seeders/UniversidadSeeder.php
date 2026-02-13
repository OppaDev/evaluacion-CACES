<?php

namespace Database\Seeders;

use App\Models\Universidad;
use Illuminate\Database\Seeder;

class UniversidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Universidad::create([
            'universidad' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE',
            'foto' => '',
            'campus' => 'SANGOLQUI',
            'sede' => 'SANGOLQUI',
            'ciudad' => 'SANGOLQUI',
            'informe' => '',
        ]);

        Universidad::create([
            'universidad' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE',
            'foto' => '',
            'campus' => 'LATACUNGA',
            'sede' => 'LATACUNGA',
            'ciudad' => 'LATACUNGA',
            'informe' => '',
        ]);

        Universidad::create([
            'universidad' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE',
            'foto' => '',
            'campus' => 'SANTO DOMINGO',
            'sede' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'informe' => '',
        ]);
    }
}
