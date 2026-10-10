<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_manage_users(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('Usuarios');

        $this->post(route('users.store'), [
            'name' => 'Ana',
            'paterno' => 'Lopez',
            'materno' => 'Diaz',
            'email' => 'ana.lopez@example.com',
            'direccion' => 'Calle Central 123',
            'carnet' => '1234567',
            'telefono' => '70000000',
        ])->assertRedirect(route('users.index'));

        $user = User::where('email', 'ana.lopez@example.com')->firstOrFail();

        $this->assertDatabaseHas('users', [
            'name' => 'Ana',
            'paterno' => 'Lopez',
            'materno' => 'Diaz',
            'email' => 'ana.lopez@example.com',
            'direccion' => 'Calle Central 123',
            'carnet' => '1234567',
            'telefono' => '70000000',
        ]);

        $this->get(route('users.edit', $user))
            ->assertOk()
            ->assertSee('Editar usuario');

        $this->put(route('users.update', $user), [
            'name' => 'Ana Maria',
            'paterno' => 'Lopez',
            'materno' => 'Diaz',
            'email' => 'ana.lopez@example.com',
            'direccion' => 'Avenida Nueva 456',
            'carnet' => '1234567',
            'telefono' => '70000000',
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Ana Maria',
            'direccion' => 'Avenida Nueva 456',
        ]);

        $this->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}