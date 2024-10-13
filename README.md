<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Тестовое приложение "Каталог машин" на Laravel 11

**Описание задачи:**

- Спроектировать базу данных автомобилей: бренд, модель, год выпуска, цена, тип двигателя (бензиновый, дизельный, гибридный, электрический), тип привода (передний, задний, полный), массив изображений авто.
- Создать миграции.
- Заполнить спроектированную базу данных тестовыми данными, используя **fake-factory**.
- Реализовать страницу каталога товаров с фильтром по заданным характеристикам.

**Обязательные требования**

- Применение фильтра должно работать без перезагрузки страницы.
- После обновления страницы в url должны сохранятся параметры фильтрации.

**Опционально**

- Реализовать постраничную разбивку данных (пагинация).
- Добавить возможность указания колличества записей выводимых на одну страницу.

### Используемый Stack

#### Основные компоненты среды разработки:

- PHP 8.3-FCGI
- Nginx 1.26
- SQLite 3.41.2 (default)
- NodeJS 20.11.1
- Git 2.47

#### Основные технологии:

- Laravel 11.26
- Inertiajs 1.3 (Vue 3 + Composition API + TS)
- Tailwindcss 3.4
- Vite 5

### Развёртывание и запуск:

- `composer install`
- `npm install`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`
- `npm run dev`

_для запуска в файле **.env** должны быть созданы переменные окружения по примеру **.env.example**_
