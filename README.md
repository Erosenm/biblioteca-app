Desde el menú lateral, entra en **Usuarios** para ver los registros guardados. Usa **Nuevo usuario** para abrir el formulario, que solicita nombre, apellido paterno, apellido materno, email, dirección, carnet y teléfono. El botón **Registrar** valida los datos y guarda el registro en la tabla `users`; email, carnet y teléfono deben ser únicos. La tabla permite buscar por carnet y cambiar el estado de cada usuario entre **Activo** e **Inactivo**; el cambio se guarda inmediatamente en la base de datos. En cada fila también están las acciones **Editar** y **Eliminar**; editar permite guardar cambios y eliminar pide confirmación.
Las columnas `paterno`, `materno`, `direccion`, `carnet` y `telefono` se agregan mediante la migración `database/migrations/2026_10_03_000000_add_personal_details_to_users_table.php`. La columna booleana `activo` se agrega mediante `database/migrations/2026_10_10_000000_add_activo_to_users_table.php`; los usuarios existentes quedan activos por defecto. Los campos personales son opcionales en el esquema para mantener compatibles los usuarios creados mediante el registro normal de Jetstream, aunque el formulario de administración pide todos los datos.
# Biblioteca App

Aplicación de gestión de usuarios hecha con Laravel 13, Livewire 3, Jetstream, Tailwind CSS, Vite y MariaDB/SQLite.

## Requisitos

- PHP 8.3 o superior y Composer.
- Node.js y npm.
- Extensión PHP `pdo_sqlite` para usar la configuración predeterminada, o `pdo_mysql` si se usará MariaDB.
- Git.

## Descargar e instalar

Clona el repositorio y entra a la carpeta:

```bash
git clone https://github.com/Erosenm/biblioteca-app.git
cd biblioteca-app
```

Crea la configuración local e instala las dependencias:

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
```

Por defecto, el proyecto usa SQLite. Crea el archivo de base de datos y ejecuta las migraciones:

```bash
touch database/database.sqlite
php artisan migrate
```

En Windows PowerShell, crea el archivo SQLite con:

```powershell
New-Item -ItemType File -Path database/database.sqlite
```

Si prefieres MariaDB, crea una base de datos local, configura `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en tu `.env`, y luego ejecuta `php artisan migrate`. No compartas tu `.env` ni sus contraseñas.

## Iniciar la aplicación

Abre dos terminales desde la carpeta del proyecto. En la primera:

```bash
php artisan serve
```

En la segunda:

```bash
npm run dev
```

Visita <http://localhost:8000>. Regístrate en `/register` e inicia sesión para entrar al dashboard. La sección de usuarios está en `/users`.

