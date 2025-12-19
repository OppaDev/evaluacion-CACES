<?php

namespace Database\Factories;

use App\Models\Universidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Universidad>
 */
class UniversidadFactory extends Factory
{
    protected $model = Universidad::class;

    public function definition()
    {
        return [
            'universidad' => $this->faker->word,
            'codigo_unico' => $this->faker->unique()->uuid,
            'foto' => $this->faker->imageUrl,
            'campus' => $this->faker->word,
            'sede' => $this->faker->word,
            'ciudad' => $this->faker->city,
            'facultad' => $this->faker->word,
            'departamento' => $this->faker->word,
            'fecha_evaluacion' => $this->faker->date,
            'evaluadores' => $this->faker->name,
            'contraparte' => $this->faker->name,
            'informe' => $this->faker->text(250),
        ];
    }
}
