
<div>
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="w-full max-w-md">
            <label for="buscar-carnet" class="mb-1.5 block text-sm font-semibold text-slate-700">Buscar por carnet</label>
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"></i>
                <input
                    id="buscar-carnet"
                    type="search"
                    wire:model.live.debounce.300ms="buscarCarnet"
                    placeholder="Escriba el número de carnet"
                    class="w-full rounded-md border border-slate-300 bg-white py-2.5 pl-9 pr-3 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                >
            </div>
        </div>

        <p class="text-sm text-slate-500" aria-live="polite">
            <span class="font-semibold text-slate-800">{{ $users->count() }}</span>
            {{ $users->count() === 1 ? 'usuario encontrado' : 'usuarios encontrados' }}
        </p>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[1050px] table-fixed text-left text-sm">
            <colgroup>
                <col class="w-[200px]">
                <col class="w-[220px]">
                <col class="w-[190px]">
                <col class="w-[120px]">
                <col class="w-[120px]">
                <col class="w-[200px]">
            </colgroup>
            <thead class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase text-slate-600">
                <tr>
                    <th class="px-4 py-3.5">Usuario</th>
                    <th class="px-4 py-3.5">Contacto</th>
                    <th class="px-4 py-3.5">Dirección</th>
                    <th class="px-4 py-3.5">Carnet</th>
                    <th class="px-4 py-3.5">Estado</th>
                    <th class="px-4 py-3.5">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                @forelse ($users as $user)
                    <tr wire:key="usuario-{{ $user->id }}" class="align-middle transition-colors hover:bg-blue-50/60">
                        <td class="break-words px-4 py-4">
                            <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                            <p class="mt-0.5 text-xs text-slate-500">{{ $user->paterno }} {{ $user->materno }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="break-all text-slate-800">{{ $user->email }}</p>
                            <p class="mt-0.5 text-xs text-slate-500">{{ $user->telefono ?: 'Sin teléfono' }}</p>
                        </td>
                        <td class="break-words px-4 py-4 text-slate-600">{{ $user->direccion }}</td>
                        <td class="break-words px-4 py-4 font-mono text-sm text-slate-700">{{ $user->carnet }}</td>
                        <td class="whitespace-nowrap px-4 py-3.5">
                            <span @class([
                                'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold',
                                'bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-600/20' => $user->activo,
                                'bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-600/20' => ! $user->activo,
                            ])>
                                <span @class([
                                    'mr-1.5 h-1.5 w-1.5 rounded-full',
                                    'bg-emerald-600' => $user->activo,
                                    'bg-rose-600' => ! $user->activo,
                                ])></span>
                                {{ $user->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <button
                                    type="button"
                                    wire:click="cambiarEstado({{ $user->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="cambiarEstado({{ $user->id }})"
                                    @class([
                                        'inline-flex items-center gap-1.5 rounded-md px-2.5 py-2 text-xs font-semibold transition disabled:cursor-wait disabled:opacity-50',
                                        'bg-rose-50 text-rose-700 hover:bg-rose-100' => $user->activo,
                                        'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' => ! $user->activo,
                                    ])
                                >
                                    <i class="fa-solid {{ $user->activo ? 'fa-user-slash' : 'fa-user-check' }}" aria-hidden="true"></i>
                                    {{ $user->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-50" title="Editar usuario">
                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>Editar
                                </a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('¿Eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-50" title="Eliminar usuario">
                                        <i class="fa-solid fa-trash-can" aria-hidden="true"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <i class="fa-regular fa-folder-open mb-2 block text-2xl text-slate-300" aria-hidden="true"></i>
                            <p class="font-medium text-slate-700">{{ $buscarCarnet ? 'No se encontraron usuarios' : 'No hay usuarios registrados' }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $buscarCarnet ? 'Prueba con otro número de carnet.' : 'Los usuarios registrados aparecerán aquí.' }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
