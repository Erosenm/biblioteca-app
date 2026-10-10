<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ListaUsuario extends Component
{
    public string $buscarCarnet = '';

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