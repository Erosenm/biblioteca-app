<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index-user');
    }

    public function create(): View
    {
        return view('users.new_user');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedUserData($request);

        User::create([
            ...$validated,
            'password' => Str::random(40),
        ]);

        return redirect()->route('users.index')->with('status', 'Usuario registrado exitosamente.');
    }

    public function edit(User $user): View
    {
        return view('users.update_user', ['usuario' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($this->validatedUserData($request, $user));

        return redirect()->route('users.index')->with('status', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', 'Usuario eliminado exitosamente.');
    }

    private function validatedUserData(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'paterno' => ['required', 'string', 'max:255'],
            'materno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'direccion' => ['required', 'string', 'max:255'],
            'carnet' => ['required', 'string', 'max:50', Rule::unique('users', 'carnet')->ignore($user?->id)],
            'telefono' => ['required', 'string', 'max:30', Rule::unique('users', 'telefono')->ignore($user?->id)],
        ], attributes: [
            'name' => 'nombre',
            'paterno' => 'apellido paterno',
            'materno' => 'apellido materno',
            'email' => 'correo electrónico',
            'direccion' => 'dirección',
            'carnet' => 'carnet',
            'telefono' => 'teléfono',
        ]);
    }
}