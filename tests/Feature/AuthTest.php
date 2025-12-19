<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_user()
    {
        // Datos del usuario
        $userData = [
            'name' => 'Erick Riascos',
            'email' => 'egriascos@espe.edu.ec',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Realizar la solicitud de registro
        $response = $this->post('/register', $userData);

        // Verificar redirección y estado de autenticación
        $response->assertRedirect('/universidades');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'egriascos@espe.edu.ec',
        ]);
    }

    /** @test */
    public function it_requires_password_confirmation_for_registration()
    {
        // Datos del usuario sin confirmar la contraseña
        $userData = [
            'name' => 'Erick Riascos',
            'email' => 'egriascos@espe.edu.ec',
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword',
        ];

        // Realizar la solicitud de registro
        $response = $this->post('/register', $userData);

        // Verificar que la solicitud falló
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /** @test */
    public function it_logs_in_an_existing_user()
    {
        // Crear un usuario
        $user = User::factory()->create([
            'email' => 'egriascos@espe.edu.ec',
            'password' => bcrypt('password123'),
        ]);

        // Datos de inicio de sesión
        $loginData = [
            'email' => 'egriascos@espe.edu.ec',
            'password' => 'password123',
        ];

        // Realizar la solicitud de inicio de sesión
        $response = $this->post('/login', $loginData);

        // Verificar redirección y estado de autenticación
        $response->assertRedirect('/universidades');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_prevents_login_with_invalid_credentials()
    {
        // Crear un usuario
        $user = User::factory()->create([
            'email' => 'egriascos@espe.edu.ec',
            'password' => bcrypt('password123'),
        ]);

        // Datos de inicio de sesión incorrectos
        $loginData = [
            'email' => 'egriascos@espe.edu.ec',
            'password' => 'wrongpassword',
        ];

        // Realizar la solicitud de inicio de sesión
        $response = $this->post('/login', $loginData);

        // Verificar que la solicitud falló
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
