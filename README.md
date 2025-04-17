# TrustyOne — Тестовое задание

Полноценное Laravel-приложение с административной панелью (FilamentPHP), публичным frontend на Blade (Laravel Breeze) и REST API.

---

## 🔧 Технологии
- Laravel 12
- PHP 8.2
- MySQL 8
- FilamentPHP 3
- Breeze (Blade)
- Spatie Laravel Permission
- Spatie Media Library
- Leaflet.js (карты)
- Docker

---

## 📦 Установка

```bash
git clone https://github.com/boris-shakhverdyan/laravel-filament-admin.git
cd laravel-filament-admin
cp .env.example .env
docker-compose build
docker-compose up -d
```

Затем:

```bash
docker exec -it app php artisan migrate:fresh --seed
```

Фронт соберётся автоматически в Docker (`npm install && npm run build`)

---

## Авторизация

### Админка: `/admin`
- Email: `admin@test.com`
- Пароль: `123123123`

Роли: `admin`, `editor`, `viewer` — ограничение по действиям (CRUD, CRU, R)

### Публичная часть
- Главная: `/` (список активностей)
- Партёры: `/partners`
- Избранное: `/favorites` (только для зарегистрированных)

---

## Функциональность

- 🔹 Админка: управление пользователями, активностями, типами, партёрами, ролями
- 🔹 Фронт: зарегистрированный юзер может добавлять/удалять избранного
- 🔹 Полигоны: визуализация координат на карте полигонами (Leaflet)
- 🔹 Роли скорректно разграничивают доступ
- 🔹 Версии API, UI и admin отделены

---

## API

Доступен публично по `/api`:
- `/api/users`
- `/api/partners`
- `/api/activities`

Возвращает JSON с связанными моделями и пагинацией

---

## Что сделано:

| Часть                              | Статус |
|----------------------------------|---------|
| Docker + Laravel                | ✅      |
| Filament (CRUD + roles)        | ✅      |
| REST API                       | ✅      |
| Breeze frontend + auth         | ✅      |
| Избранное                      | ✅      |
| Карты + полигоны               | ✅      |
| Партнёры и типы активности     | ✅      |
| Сидеры, миграции               | ✅      |
| README                         | ✅      |

---

## Автор

**Борис**  
Email: boris@shakhverdyan.com  
Telegram: @boris_shakhverdyan
