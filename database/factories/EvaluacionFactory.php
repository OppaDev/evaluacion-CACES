<?php

namespace Database\Factories;

use App\Models\Evaluacion;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluacion>
 */
class EvaluacionFactory extends Factory
{
    protected $model = Evaluacion::class;

    public function definition()
    {
        return [
            'uni_id' => Universidad::factory(),
            'user_id' => User::factory(),
            'fecha_creacion' => $this->faker->date(),
        ];
    }
}
