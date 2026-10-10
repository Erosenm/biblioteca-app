<x-app-layout>
	<div x-data="{ abierto: false }" class="min-h-[calc(100vh-4rem)] bg-slate-100">
		<x-sidebar />

		<div>
			<header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm sm:px-6">
				<div class="flex items-center gap-3">
					<button type="button" @click="abierto = !abierto" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100" aria-label="Abrir o cerrar menú">
						<i class="fa-solid fa-bars" aria-hidden="true"></i>
					</button>
					<h1 class="text-xl font-semibold text-slate-800">Editar usuario</h1>
				</div>
				<a href="{{ route('users.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Volver</a>
			</header>

			<main class="max-w-3xl p-6 sm:p-8">
				<form method="POST" action="{{ route('users.update', $usuario) }}" class="space-y-4 rounded border border-slate-200 bg-white p-6">
					@csrf
					@method('PUT')

					@foreach ([
						'name' => 'Nombre',
						'paterno' => 'Apellido paterno',
						'materno' => 'Apellido materno',
						'email' => 'Email',
						'direccion' => 'Dirección',
						'carnet' => 'Carnet',
						'telefono' => 'Teléfono',
					] as $field => $label)
						<div>
							<label for="{{ $field }}" class="mb-1 block text-sm font-medium text-slate-700">{{ $label }}</label>
							<input
								id="{{ $field }}"
								name="{{ $field }}"
								value="{{ old($field, $usuario->$field) }}"
								@if ($field === 'email') type="email" @elseif ($field === 'telefono') type="tel" @endif
								required
								maxlength="{{ $field === 'carnet' ? 50 : ($field === 'telefono' ? 30 : 255) }}"
								class="w-full rounded border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
							>
							@error($field) <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
						</div>
					@endforeach

					<button type="submit" class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Guardar cambios</button>
				</form>
			</main>
		</div>
	</div>
</x-app-layout>
