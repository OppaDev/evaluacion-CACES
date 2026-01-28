<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user1 = [
            'name' => 'ERICK GERMAN RIASCOS MORENO',
            'email' => 'egriascos@espe.edu.ec',
            'password' => Hash::make('12345678'),
        ];
        $user2 = [
            'name' => 'NARCISA DE JESUS BAQUERO FONSECA',
            'email' => 'ndbaquero1@espe.edu.ec',
            'password' => '$2y$10$2IoM2XWI36sTHG/diSyV4OFSiyDSZEK//juHL5N4wmlZi0s8B0W9C',
        ];
        $user3 = [
            'name' => 'LUIS ALEJANDRO LEVOYER ROMERO',
            'email' => 'lalevoyer@espe.edu.ec',
            'password' => '$2y$10$ZeQ.g5wIssAasTY3fUK7ZOC2V/yARdC.trbPiLrigjszs5pKym90O',
        ];
        User::create($user1)->assignRole('Admin');
        User::create($user2)->assignRole('Admin');
        User::create($user3)->assignRole('Admin');

        // Usuarios de prueba con rol Viewer
        $testUsers = [
            ['name' => 'Usuario Prueba 1', 'email' => 'prueba1@test.com', 'password' => Hash::make('prueba123')],
            ['name' => 'Usuario Prueba 2', 'email' => 'prueba2@test.com', 'password' => Hash::make('prueba123')],
            ['name' => 'Usuario Prueba 3', 'email' => 'prueba3@test.com', 'password' => Hash::make('prueba123')],
            ['name' => 'Usuario Prueba 4', 'email' => 'prueba4@test.com', 'password' => Hash::make('prueba123')],
            ['name' => 'Usuario Prueba 5', 'email' => 'prueba5@test.com', 'password' => Hash::make('prueba123')],
        ];

        foreach ($testUsers as $testUser) {
            User::create($testUser)->assignRole('Viewer');
        }
    }
}
