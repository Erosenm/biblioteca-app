
<div>
    <div class="mb-4 max-w-sm">
        <label for="buscar-carnet" class="mb-1 block text-sm font-medium text-slate-700">Buscar usuario por carnet</label>
        <input
            id="buscar-carnet"
            type="search"
            wire:model.live.debounce.300ms="buscarCarnet"
            placeholder="Escriba su carnet"
            class="w-full rounded border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
        >
    </div>

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
                <tr wire:key="usuario-{{ $user->id }}">
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
</div>
