<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Universidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener sedes creadas por UniversidadSeeder
        $sedeSangolqui = Universidad::where('sede', 'SANGOLQUI')->first();
        $sedeLatacunga = Universidad::where('sede', 'LATACUNGA')->first();
        $sedeSantoDomingo = Universidad::where('sede', 'SANTO DOMINGO')->first();

        // --- Usuarios Admin (vinculados a sede SANGOLQUI) ---
        $admin1 = User::create([
            'name' => 'ERICK GERMAN RIASCOS MORENO',
            'email' => 'egriascos@espe.edu.ec',
            'password' => Hash::make('12345678'),
        ]);
        $admin1->assignRole('Admin');
        if ($sedeSangolqui) $admin1->universidades()->attach($sedeSangolqui->id);

        $admin2 = User::create([
            'name' => 'NARCISA DE JESUS BAQUERO FONSECA',
            'email' => 'ndbaquero1@espe.edu.ec',
            'password' => '$2y$10$2IoM2XWI36sTHG/diSyV4OFSiyDSZEK//juHL5N4wmlZi0s8B0W9C',
        ]);
        $admin2->assignRole('Admin');
        if ($sedeSangolqui) $admin2->universidades()->attach($sedeSangolqui->id);

        $admin3 = User::create([
            'name' => 'LUIS ALEJANDRO LEVOYER ROMERO',
            'email' => 'lalevoyer@espe.edu.ec',
            'password' => '$2y$10$ZeQ.g5wIssAasTY3fUK7ZOC2V/yARdC.trbPiLrigjszs5pKym90O',
        ]);
        $admin3->assignRole('Admin');
        if ($sedeSangolqui) $admin3->universidades()->attach($sedeSangolqui->id);

        // --- Usuarios de prueba (distribuidos entre sedes) ---
        $testUsers = [
            // Sede SANGOLQUI
            ['name' => 'CARLOS ANDRES MARTINEZ', 'email' => 'prueba1@test.com', 'sede' => $sedeSangolqui],
            ['name' => 'MARIA JOSE PAREDES',     'email' => 'prueba2@test.com', 'sede' => $sedeSangolqui],
            // Sede LATACUNGA
            ['name' => 'JORGE LUIS SALAZAR',     'email' => 'prueba3@test.com', 'sede' => $sedeLatacunga],
            ['name' => 'ANA LUCIA HERRERA',      'email' => 'prueba4@test.com', 'sede' => $sedeLatacunga],
            // Sede SANTO DOMINGO
            ['name' => 'PEDRO PABLO CAICEDO',    'email' => 'prueba5@test.com', 'sede' => $sedeSantoDomingo],
        ];

        foreach ($testUsers as $data) {
            $sede = $data['sede'];
            unset($data['sede']);
            $data['password'] = Hash::make('prueba123');

            $user = User::create($data);
            $user->assignRole('Viewer');
            if ($sede) $user->universidades()->attach($sede->id);
        }
    }
}
