<x-app-layout>
    <div x-data="{ abierto: false }" class="min-h-[calc(100vh-4rem)] bg-slate-100">
        <x-sidebar />

        <div>
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm sm:px-6">
                <div class="flex items-center gap-3">
                    <button type="button" @click="abierto = !abierto" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100" aria-label="Abrir o cerrar menú">
                        <i class="fa-solid fa-bars" aria-hidden="true"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-slate-800">Usuarios</h1>
                </div>
                <a href="{{ route('users.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Nuevo usuario</a>
            </header>

            <main class="p-6 sm:p-8">
                @if (session('status'))
                    <p class="mb-4 text-sm text-green-700">{{ session('status') }}</p>
                @endif
                @if (session('error'))
                    <p class="mb-4 text-sm text-red-700">{{ session('error') }}</p>
                @endif

                <div class="overflow-x-auto rounded border border-slate-200 bg-white">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-medium">Nombre</th>
                                <th class="px-4 py-3 font-medium">Apellido paterno</th>
                                <th class="px-4 py-3 font-medium">Apellido materno</th>
                                <th class="px-4 py-3 font-medium">Email</th>
                                <th class="px-4 py-3 font-medium">Dirección</th>
                                <th class="px-4 py-3 font-medium">Carnet</th>
                                <th class="px-4 py-3 font-medium">Teléfono</th>
                                <th class="px-4 py-3 font-medium">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-slate-700">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-4 py-3">{{ $user->name }}</td>
                                    <td class="px-4 py-3">{{ $user->paterno }}</td>
                                    <td class="px-4 py-3">{{ $user->materno }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">{{ $user->direccion }}</td>
                                    <td class="px-4 py-3">{{ $user->carnet }}</td>
                                    <td class="px-4 py-3">{{ $user->telefono }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">
                                        <a href="{{ route('users.edit', $user) }}" class="text-blue-700 hover:underline">Editar</a>
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" class="ml-3 inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-slate-500">No hay usuarios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>

