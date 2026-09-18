# AGENTS.md

Aplicación Laravel 10 (Jetstream stack Livewire + spatie/laravel-permission). Dominio en español, corre bajo XAMPP en Windows.

## Entorno: PHP obligatorio

- El `php` del PATH (`C:\Program Files\PHP\php.exe`) **no tiene `pdo_mysql`** → todo lo que toque la BD (artisan, migrate, tests) falla con `could not find driver`.
- Usa siempre el PHP de XAMPP: `C:\xampp\php\php.exe artisan ...`. `vendor/` y `node_modules/` ya están instalados.

## Setup

- `.env` se copia desde `.env.example` (está en `.gitignore`). No uses el `.env` local para construir flujos nuevos.
- BD MySQL local: `knowledgemanagementsystem`, user `root` sin password (`.env`). Crea la BD y corre `php artisan migrate`.
- `SESSION_DRIVER=database`: la migración de `sessions` es obligatoria, no la quites.

## Correr la app

- Backend: `C:\xampp\php\php.exe artisan serve` → `http://127.0.0.1:8000` (coincide con `APP_URL`).
- Frontend: todas las vistas usan `@vite`. `public/build` y `public/hot` están en `.gitignore`:
  - dev: `npm run dev` (Vite en :5173, crea `public/hot`).
  - un clon/CI sin build fallará los estilos hasta correr `npm run build`.

## Seeders (comportamiento no obvio)

- `php artisan db:seed` solo siembra catálogos (regional, centro, grupo, linea, semillero).
- Roles y usuario admin **no** se siembran con `db:seed`. Corre aparte y en orden:
  ```
  php artisan db:seed --class=RolesSeeder
  php artisan db:seed --class=AdminUserSeeder
  ```
  Credenciales admin por defecto: `admin@example.com` / `password123`.

## Auth y rutas

- Roles: `admin`, `instructor`, `aprendiz` (spatie). Middleware alias `role` está en `app/Http/Kernel.php`.
- Rutas admin en la raíz (CRUD `regionales`, `centros`, `grupos`, `lineas`, `semilleros`, `anteproyectos`).
- Rutas de aprendiz bajo prefijo `/aprendiz`: wizard de anteproyectos en pasos (`createStep1`..`createStep4`, `storeStep1`..`storeStep4`) en `app/Http/Controllers/Aprendiz/AnteproyectoController.php`.

## Tests

- Corren con el PHP de XAMPP: `C:\xampp\php\php.exe artisan test`.
- `phpunit.xml` **no** define BD sqlite (está comentado) → los feature tests corren contra la BD MySQL local de dev. No asumas aislamiento.
- Los feature tests son los estándar de Jetstream (no cubren la lógica del negocio).

## Extras

- PDFs de anteproyectos: `barryvdh/laravel-dompdf` (rutas `generate_pdf`/`generarPdf` en los controladores admin y aprendiz).
- UI: AdminLTE + Tailwind vía Vite. Vistas en `resources/views/layouts` (`app`, `guest`, `aprendiz`).