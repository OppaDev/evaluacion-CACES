<?php

namespace Database\Seeders;

use App\Models\Universidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'campus' => 'QUITO',
            'sede' => 'QUITO',
            'ciudad' => 'QUITO',
            'facultad' => 'FACULTAD DE CIENCIAS ADMINISTRATIVAS Y ECONOMICAS',
            'departamento' => 'ADMINISTRACION DE EMPRESAS',
            'fecha_evaluacion' => '2024-08-21',
            'evaluadores' => 'ING. MARCELO REA',
            'contraparte' => 'ING. MARCELO REA',
            'informe' => '',
        ]);
    }
}
