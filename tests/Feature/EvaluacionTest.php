<?php

namespace Tests\Feature;

use App\Models\Evaluacion;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluacionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'web');
    }

    public function test_it_can_list_evaluaciones()
    {
        $universidad = Universidad::factory()->create();
        Evaluacion::factory()->count(3)->create(['uni_id' => $universidad->id]);

        $response = $this->get(route('evaluaciones.index', $universidad->id));

        $response->assertStatus(200);
        $response->assertViewHas('universidad', $universidad);
        $response->assertViewHas('evaluaciones');
        $this->assertCount(3, $response->viewData('evaluaciones'));
    }

    public function test_it_can_create_an_evaluacion()
    {
        $universidad = Universidad::factory()->create();

        $data = [
            'uni_id' => $universidad->id,
        ];

        $response = $this->post(route('evaluaciones.store'), $data);

        $response->assertStatus(302); 
        $this->assertDatabaseHas('evaluacions', [
            'uni_id' => $universidad->id,
            'user_id' => $this->user->id,
        ]);
    }
}
