<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FuenteInformacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([       
            RoleSeeder::class,     
            UserSeeder::class,
            CriterioSeeder::class,
            SubcriterioSeeder::class,
            IndicadorSeeder::class,
            ElementoFundamentalSeeder::class,
            FuenteInformacionSeeder::class,
            EscalaSeeder::class,
            FormulaSeeder::class
            // UniversidadSeeder::class,
            // ValidacionLineamientoSeeder::class
        ]);
    }
}
