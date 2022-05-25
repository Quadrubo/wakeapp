# WakeApp

## Installation

1) Install PHP > V8 and Composer.
2) Clone this Project with `git clone https://github.com/Quadrubo/wakeapp`.
3) Run `composer install`.
4) Run `npm install`.
5) Copy `.env.example` and rename the copy to `.env`.
6) Create a database named `wakeapp`.
7) Edit the Database connection details in `.env`.
8) Run `php artisan migrate` to create the tables in the database.
9) Run `php artisan key:generate` to generate a unique application key.

## Serving the Application

1) Run `php artisan serve`.
2) Run either:
  - `npm run prod` for production mode.
  - `npm run dev` for development mode.
  - `npm run watch` for development mode with auto recompiling.
  - `npm run hot` for development mode with hot reload.

