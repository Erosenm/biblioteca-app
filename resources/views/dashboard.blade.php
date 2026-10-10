<x-app-layout>
    <div x-data="{ abierto: false }" class="min-h-[calc(100vh-4rem)] bg-slate-100">
        <x-sidebar />

        <div>
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm sm:px-6">
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        @click="abierto = !abierto"
                        class="rounded-lg p-2 text-slate-600 hover:bg-slate-100"
                        aria-label="Abrir o cerrar menú"
                    >
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-slate-800">Biblioteca APP</h1>
                </div>
                <span class="text-sm text-slate-500">Panel principal</span>
            </header>

            <main class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-slate-800">Bienvenido</h2>
                <p class="mt-2 text-slate-600">Selecciona una opción del menú para comenzar.</p>
            </main>
        </div>
    </div>
</x-app-layout>