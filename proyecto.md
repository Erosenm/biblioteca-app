La lista permite buscar por carnet, muestra el estado **Activo/Inactivo** y ofrece un botón Livewire para cambiarlo; la modificación se guarda en la base de datos. También ofrece acciones para editar y eliminar. El alta y edición manejan nombre, apellidos paterno y materno, email, dirección, carnet y teléfono. Email, carnet y teléfono se validan como únicos en `UserController`; email y carnet también tienen índice único en la base de datos. El campo `telefono` no tiene índice único en la migración actual.
El estado se almacena en la columna booleana `users.activo`, añadida por `database/migrations/2026_10_10_000000_add_activo_to_users_table.php`. Su valor predeterminado es `true`, por lo que las cuentas ya existentes quedan activas. Por ahora, el estado solo se muestra y modifica desde la administración; no bloquea el inicio de sesión.
- `app/Livewire/ListaUsuario.php`: componente que obtiene los usuarios y filtra por carnet.
- `database/migrations/2026_10_10_000000_add_activo_to_users_table.php`: agrega el estado de usuario con valor predeterminado activo.
# Contexto del proyecto: Biblioteca App

Última actualización: 2026-10-10.

## Resumen

Aplicación web construida con Laravel 13.25, PHP 8.3 o superior, Jetstream, Fortify, Livewire 3, Tailwind CSS, Alpine.js, Vite y MariaDB o SQLite. Actualmente el trabajo funcional principal está en el registro y administración de usuarios. El nombre Biblioteca App aparece en el menú, pero todavía no hay gestión de libros implementada.

Repositorio remoto configurado: `https://github.com/Erosenm/biblioteca-app.git`. La rama local `main` sigue a `origin/main`; el push inicial se completó correctamente.

## Cómo se ejecuta

El README principal tiene los pasos completos de instalación. Resumen:

1. Crear `.env` copiando `.env.example` e instalar dependencias con Composer y npm.
2. Generar la clave con `php artisan key:generate`.
3. Por defecto, el ejemplo usa SQLite. Crear `database/database.sqlite` y ejecutar `php artisan migrate`. Se necesita `pdo_sqlite` habilitado en PHP. También se puede configurar MariaDB en el `.env` local.
4. Ejecutar `php artisan serve` y `npm run dev` en terminales separadas.

No subir `.env`, contraseñas, tokens, ni bases de datos con registros locales. `.gitignore` ignora `.env`, `vendor`, `node_modules`, `public/build` y `/database/*.sqlite*`. Cada colaborador debe crear su propio `.env` y su propia base local.

## Funciones implementadas

### Acceso y dashboard

- `/` muestra la bienvenida.
- `/register` y `/login` pertenecen al flujo de autenticación Jetstream/Fortify.
- `/dashboard` requiere autenticación y verificación.
- `/user/profile` es el perfil de Jetstream.
- El dashboard y las vistas de usuarios reutilizan el layout de Jetstream.
- El sidebar tiene enlaces funcionales para Home y Usuarios. Proyectos y Configuración son por ahora enlaces `#` sin pantallas funcionales.
- Los iconos Font Awesome se cargan desde CDN en `resources/views/layouts/app.blade.php`; se necesita conexión a internet para mostrarlos.

### Administración de usuarios

Rutas protegidas por autenticación:

- `GET /users`: lista de usuarios.
- `GET /users/create` y `POST /users`: alta.
- `GET /users/{user}/edit`, `PUT/PATCH /users/{user}`: edición.
- `DELETE /users/{user}`: eliminación.

La lista permite buscar por carnet y ofrece acciones para editar y eliminar. El alta y edición manejan nombre, apellidos paterno y materno, email, dirección, carnet y teléfono. Email, carnet y teléfono se validan como únicos en `UserController`; email y carnet también tienen índice único en la base de datos. El campo `telefono` no tiene índice único en la migración actual.

El formulario administrativo no solicita contraseña. Al crear el usuario, el controlador genera una contraseña aleatoria y el cast `hashed` del modelo `User` la almacena hasheada.

## Archivos importantes

- `routes/web.php`: rutas públicas y grupo de rutas protegidas.
- `app/Http/Controllers/UserController.php`: alta, edición, eliminación y validación del CRUD.
- `app/Livewire/ListaUsuario.php`: componente que obtiene los usuarios y filtra por carnet.
- `resources/views/livewire/lista_usuario.blade.php`: buscador y tabla reactiva de usuarios.
- `resources/views/users/index-user.blade.php`: página que monta `<livewire:lista-usuario />`.
- `resources/views/users/new_user.blade.php`: formulario de alta.
- `resources/views/users/update_user.blade.php`: formulario de edición.
- `resources/views/dashboard.blade.php` y `resources/views/components/sidebar.blade.php`: panel y navegación.
- `app/Models/User.php`: campos asignables, traits Jetstream/Sanctum y cast de contraseña.
- `database/migrations/`: esquema de usuarios, campos personales, caché, colas, autenticación de dos factores, passkeys y tokens API.
- `README.md`: instalación, ejecución local y pasos para publicar el repositorio.

## Cómo funciona la búsqueda Livewire

`ListaUsuario` declara la propiedad pública `$buscarCarnet`. En `render()` limpia el texto, aplica `where('carnet', 'like', ...)` cuando hay búsqueda, ordena por nombre y envía la colección a `livewire.lista_usuario`. El input usa `wire:model.live.debounce.300ms`, por lo que actualiza la tabla mientras se escribe sin enviar un formulario tradicional. La vista Livewire debe conservar una única raíz HTML.

## Validaciones y pendientes conocidos

- `php artisan view:cache` se ejecutó correctamente tras implementar la búsqueda.
- `php -l app/Livewire/ListaUsuario.php` no reportó errores.
- `php artisan route:list --path=users` mostró las seis rutas CRUD esperadas.
- `tests/Feature/UserManagementTest.php` no pudo ejecutarse en el entorno usado: PHPUnit configura SQLite en memoria, pero PHP respondió `could not find driver`. Habilitar/instalar `pdo_sqlite` permitiría ejecutar esa prueba con la configuración actual.
- `routes/web.php` declara `Route::resource('users', ...)` dos veces con acciones superpuestas. La lista de rutas no mostró duplicados, pero conviene consolidar esas declaraciones si se modifica el archivo.
- La base de datos, usuarios locales y credenciales no forman parte del repositorio; se comparten las migraciones y el código.
