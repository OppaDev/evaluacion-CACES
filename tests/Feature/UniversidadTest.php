<?php

namespace Tests\Feature;

use App\Models\Universidad;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UniversidadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'web');
    }

    public function test_it_can_create_a_universidad()
    {
        Storage::fake('public');

        $data = [
            'universidad' => $this->faker->word,
            'campus' => 'Main Campus',
            'foto' => UploadedFile::fake()->image('foto.jpg'),
            'informe' => UploadedFile::fake()->create('informe.pdf', 100),
        ];

        $response = $this->post(route('universidades.store'), $data);

        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('universidads', [
            'universidad' => $data['universidad'],
            'campus' => 'Main Campus',
        ]);
    }

    public function test_it_can_update_a_universidad()
    {
        Storage::fake('public');

        $universidad = Universidad::factory()->create();

        $data = [
            'universidad' => 'Updated University',
            'campus' => 'Updated Campus',
            'foto' => UploadedFile::fake()->image('foto.jpg'),
            'informe' => UploadedFile::fake()->create('informe.pdf', 100),
        ];

        $response = $this->put(route('universidades.update', $universidad->id), $data);

        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('universidads', [
            'id' => $universidad->id,
            'universidad' => 'Updated University',
            'campus' => 'Updated Campus',
        ]);
    }

    public function test_it_can_delete_a_universidad()
    {
        $universidad = Universidad::factory()->create();

        $response = $this->delete(route('universidades.destroy', $universidad->id));

        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('universidads', [
            'id' => $universidad->id,
        ]);
    }

    public function test_it_can_list_universidades()
    {
        Universidad::factory()->count(3)->create();

        $response = $this->get(route('universidades.index'));

        $response->assertStatus(200);
        $response->assertViewHas('universidades');
    }

    public function test_it_can_show_a_universidad()
    {
        $universidad = Universidad::factory()->create();

        $response = $this->get(route('universidades.edit', $universidad->id));

        $response->assertStatus(200);
        $response->assertViewHas('universidad', $universidad);
    }
}
