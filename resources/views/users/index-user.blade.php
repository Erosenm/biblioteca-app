<x-app-layout>
    <div x-data="{ abierto: false }" class="min-h-[calc(100vh-4rem)] bg-slate-100">
        <x-sidebar />

        <div>
            <header class="flex h-16 items-center border-b border-slate-200 bg-white px-4 shadow-sm sm:px-6">
                <div class="flex items-center gap-3">
                    <button type="button" @click="abierto = !abierto" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100" aria-label="Abrir o cerrar menú">
                        <i class="fa-solid fa-bars" aria-hidden="true"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-slate-800">Usuarios</h1>
                </div>
            </header>

            <main class="p-6 sm:p-8">
                @if (session('status'))
                    <p class="mb-4 text-sm text-green-700">{{ session('status') }}</p>
                @endif
                @if (session('error'))
                    <p class="mb-4 text-sm text-red-700">{{ session('error') }}</p>
                @endif

                <livewire:lista-usuario />
            </main>
        </div>
    </div>
</x-app-layout>