<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Функциональность

- Регистрация и вход пользователя
- Создание короткой ссылки по оригинальному URL
- Редирект по короткой ссылке на оригинальный URL
- Фиксация каждого перехода: IP-адрес, дата и время
- Личный кабинет пользователя:
  - список своих ссылок с количеством переходов
  - удаление ссылки
  - детальная статистика переходов по каждой ссылке
- Доступ к статистике и удалению — только у владельца ссылки (остальным — 403)

## Требования к окружению

- PHP 8.2+
- Composer
- Node.js + npm
- Расширение PHP `pdo_sqlite` (если используется SQLite)

## Установка и запуск

1. **Клонировать репозиторий и установить зависимости**

   ```bash
   git clone https://github.com/HadgehogProJect/shortlinks.git
   cd shortlinks
   composer install
   npm install
   ```

2. **Настроить окружение**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Создать файл базы данных SQLite**

   Linux/macOS:
   ```bash
   touch database/database.sqlite
   ```

   Windows (PowerShell):
   ```powershell
   New-Item database\database.sqlite -ItemType File
   ```

   В `.env` убедиться, что указано:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/абсолютный/путь/до/проекта/database/database.sqlite
   ```
   (На Windows рекомендуется указывать полный путь, например `DB_DATABASE=C:\путь\к\проекту\database\database.sqlite`)

   Если нужна MySQL/PostgreSQL — заменить блок `DB_*` в `.env` на свои данные подключения и создать БД вручную перед миграцией.

4. **Применить миграции**

   ```bash
   php artisan migrate
   ```

5. **Собрать фронтенд**

   ```bash
   npm run build
   ```

6. **Запустить сервер**

   ```bash
   php artisan serve
   ```

   Приложение будет доступно на `http://127.0.0.1:8000`.

## Как проверить функциональность

1. Открыть `http://127.0.0.1:8000/register`, зарегистрировать пользователя.
2. Перейти в раздел «Мои ссылки» (`/links`).
3. Создать короткую ссылку, указав любой валидный URL (например `https://laravel.com`).
4. Открыть полученную короткую ссылку в новой вкладке — должен произойти редирект на оригинальный URL.
5. Вернуться в `/links` — у ссылки увеличится счётчик переходов.
6. Нажать «Статистика» у ссылки — откроется список переходов с IP-адресом и датой/временем.
7. Попробовать зайти на страницу статистики или удаление чужой ссылки под другим пользователем — должна быть ошибка 403.
8. Удалить ссылку — она пропадёт из списка, а переход по её короткому URL вернёт 404.

## Автоматические тесты

В проекте есть Feature-тесты, покрывающие создание ссылок, редирект с фиксацией клика, валидацию и права доступа.

Запуск:
```bash
php artisan test
```

Тесты используют отдельную in-memory SQLite-базу (настроено в `phpunit.xml`), рабочая база данных не затрагивается.

## Структура основных сущностей

- `links` — оригинальный URL, короткий код, привязка к пользователю
- `clicks` — привязка к ссылке, IP-адрес, дата и время перехода

## Известные ограничения

- Не реализована защита от создания короткой ссылки на собственный домен приложения (потенциальный риск цикличного редиректа).
- User-Agent и Referer перехода не сохраняются — по ТЗ достаточно IP и времени.
- Повторные переходы с одного IP считаются как отдельные клики (без дедупликации).
