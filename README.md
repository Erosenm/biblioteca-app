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

## Subir el proyecto a GitHub

En GitHub, crea un repositorio vacío llamado `biblioteca-app`. No lo inicialices con README, `.gitignore` ni licencia. Desde la carpeta del proyecto ejecuta:

```bash
git init
git add .
git status --short
```

Antes de continuar, comprueba que `.env`, `database/database.sqlite`, `vendor` y `node_modules` no aparezcan entre los archivos preparados. Luego:

```bash
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/Erosenm/biblioteca-app.git
git push -u origin main
```

Si GitHub muestra un error de autenticación, inicia sesión mediante GitHub CLI o configura una clave SSH. No pongas contraseñas ni tokens dentro de la URL del remoto.

## Para compartirlo con un compañero

El repositorio incluye el código y las migraciones, no la base de datos ni las cuentas locales. Tu compañero debe seguir los pasos de instalación anteriores y crear su propio `.env`. Si el repositorio es privado, agrégalo como colaborador en GitHub; si es público, podrá clonarlo directamente.
