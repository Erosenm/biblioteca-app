<x-app-layout>
    <div x-data="{ abierto: false }" class="min-h-[calc(100vh-4rem)] bg-slate-100">
        <x-sidebar />

        <div>
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm sm:px-6">
                <div class="flex items-center gap-3">
                    <button type="button" @click="abierto = !abierto" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100" aria-label="Abrir o cerrar menú">
                        <i class="fa-solid fa-bars" aria-hidden="true"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-slate-800">Registro de usuario</h1>
                </div>
                <a href="{{ route('users.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Volver</a>
            </header>

            <main class="max-w-3xl p-6 sm:p-8">
                <form method="POST" action="{{ route('users.store') }}" class="space-y-4 rounded border border-slate-200 bg-white p-6">
                    @csrf

                    <div>
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nombre</label>
                        <input id="name" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="paterno" class="mb-1 block text-sm font-medium text-slate-700">Apellido paterno</label>
                        <input id="paterno" name="paterno" value="{{ old('paterno') }}" required maxlength="255" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('paterno') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="materno" class="mb-1 block text-sm font-medium text-slate-700">Apellido materno</label>
                        <input id="materno" name="materno" value="{{ old('materno') }}" required maxlength="255" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('materno') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="direccion" class="mb-1 block text-sm font-medium text-slate-700">Dirección</label>
                        <input id="direccion" name="direccion" value="{{ old('direccion') }}" required maxlength="255" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('direccion') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="carnet" class="mb-1 block text-sm font-medium text-slate-700">Carnet</label>
                        <input id="carnet" name="carnet" value="{{ old('carnet') }}" required maxlength="50" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('carnet') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="telefono" class="mb-1 block text-sm font-medium text-slate-700">Teléfono</label>
                        <input id="telefono" name="telefono" type="tel" value="{{ old('telefono') }}" required maxlength="30" class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('telefono') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Registrar</button>
                </form>
            </main>
        </div>
    </div>
</x-app-layout>