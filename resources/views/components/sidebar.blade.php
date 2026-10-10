<div>
    <div
        x-show="abierto"
        x-cloak
        @click="abierto = false"
        class="fixed inset-0 z-30 bg-slate-900/50"
    ></div>

    <aside
        x-cloak
        x-show="abierto"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-40 mt-16 w-64 transform bg-slate-900 text-white shadow-xl"
    >
        <div class="flex items-center gap-3 border-b border-slate-700 px-6 py-5">
            <x-application-mark class="h-9 w-9" />
            <span class="text-lg font-semibold">Biblioteca APP</span>
        </div>

        <nav class="space-y-1 p-4" aria-label="Navegación principal">
            <a href="{{ route('dashboard') }}" @class([
                'block rounded-lg px-4 py-3 transition hover:bg-slate-800',
                'bg-blue-600 font-medium text-white hover:bg-blue-500' => request()->routeIs('dashboard'),
                'text-slate-200' => ! request()->routeIs('dashboard'),
            ])>
                <i class="fa-solid fa-house mr-2" aria-hidden="true"></i>Home
            </a>
            <a href="{{ route('users.index') }}" @class([
                'block rounded-lg px-4 py-3 transition hover:bg-slate-800',
                'bg-blue-600 font-medium text-white hover:bg-blue-500' => request()->routeIs('users.*'),
                'text-slate-200' => ! request()->routeIs('users.*'),
            ])>
                <i class="fa-solid fa-user mr-2" aria-hidden="true"></i>Usuarios
            </a>
            <a href="#" class="block rounded-lg px-4 py-3 text-slate-200 transition hover:bg-slate-800">
                <i class="fa-solid fa-folder mr-2" aria-hidden="true"></i>Proyectos
            </a>
            <a href="#" class="block rounded-lg px-4 py-3 text-slate-200 transition hover:bg-slate-800">
                <i class="fa-solid fa-gear mr-2" aria-hidden="true"></i>Configuración
            </a>
        </nav>
    </aside>
</div>