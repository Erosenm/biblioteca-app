<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ListaUsuario extends Component
{
    public string $buscarCarnet = '';

    public bool $modal = false;

    public string $name = '';

    public string $paterno = '';

    public string $materno = '';

    public string $email = '';

    public string $direccion = '';

    public string $carnet = '';

    public string $telefono = '';

    public function registrarUsuario(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'paterno' => ['required', 'string', 'max:255'],
            'materno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'direccion' => ['required', 'string', 'max:255'],
            'carnet' => ['required', 'string', 'max:50', Rule::unique('users', 'carnet')],
            'telefono' => ['required', 'string', 'max:30', Rule::unique('users', 'telefono')],
        ], attributes: [
            'name' => 'nombre',
            'paterno' => 'apellido paterno',
            'materno' => 'apellido materno',
            'email' => 'correo electrónico',
            'direccion' => 'dirección',
            'carnet' => 'carnet',
            'telefono' => 'teléfono',
        ]);

        User::create([
            ...$validated,
            'password' => Str::random(40),
        ]);

        $this->reset(['name', 'paterno', 'materno', 'email', 'direccion', 'carnet', 'telefono']);
        $this->resetValidation();
        $this->modal = false;

        session()->flash('status', 'Usuario registrado exitosamente.');
    }

    public function cancelarRegistro(): void
    {
        $this->reset(['name', 'paterno', 'materno', 'email', 'direccion', 'carnet', 'telefono']);
        $this->resetValidation();
        $this->modal = false;
    }

    public function cambiarEstado(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->activo = ! $user->activo;
        $user->save();
    }

    public function render(): View
    {
        $buscarCarnet = trim($this->buscarCarnet);

        return view('livewire.lista_usuario', [
            'users' => User::query()
                ->when($buscarCarnet !== '', function ($query) use ($buscarCarnet) {
                    $query->where('carnet', 'like', "%{$buscarCarnet}%");
                })
                ->orderBy('name')
                ->get(),
        ]);
    }
}