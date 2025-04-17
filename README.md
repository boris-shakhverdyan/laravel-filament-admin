# Laravel Role-Based Admin & Public Platform

A full Laravel application featuring an admin panel (FilamentPHP), public-facing frontend (Blade with Breeze), REST API, and geolocation polygon support.

---

## Tech Stack
- Laravel 12
- PHP 8.2
- MySQL 8
- FilamentPHP 3
- Breeze (Blade)
- Spatie Laravel Permission
- Spatie Media Library
- Leaflet.js (maps)
- Docker

---

## Installation

```bash
git clone https://github.com/boris-shakhverdyan/laravel-filament-admin.git
cd laravel-filament-admin
cp .env.example .env
docker-compose build
docker-compose up -d
```

Then run:

```bash
docker exec -it app php artisan migrate:fresh --seed
```

Frontend assets are compiled automatically in Docker (`npm install && npm run build`).

---

## Authentication

### Admin Panel: `/admin`
- Email: `admin@test.com`
- Password: `123123123`

Roles: `admin`, `editor`, `viewer` — each with limited access (CRUD, CRU, R).

### Public Interface
- Home: `/` (activity listing)
- Partners: `/partners`
- Favorites: `/favorites` (available for authenticated users)

---

## Functionality

- Admin Panel: manage users, activities, types, partners, roles
- Frontend: register, login, manage favorites
- Polygon support: Leaflet.js to display geolocation areas
- Role-based access: enforced across all layers
- Clean separation: admin UI, public UI, and API

---

## API

Public API endpoints available at `/api`:
- `/api/users`
- `/api/partners`
- `/api/activities`

Returns paginated JSON with relationships and structure.

---

## Features Checklist

| Feature                        | Status |
|-------------------------------|--------|
| Docker + Laravel              | ✅     |
| Filament (CRUD + roles)       | ✅     |
| REST API                      | ✅     |
| Breeze frontend + auth        | ✅     |
| Favorites logic               | ✅     |
| Maps + polygon display        | ✅     |
| Partner & activity type CRUD  | ✅     |
| Seeders & migrations          | ✅     |
| Final README                  | ✅     |

---

## Author

**Boris Shakhverdyan**  
Email: boris@shakhverdyan.com  
Telegram: @boris_shakhverdyan
