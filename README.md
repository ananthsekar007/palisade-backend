<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


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

## Prerequisites

* Have php <b>(^ v7.4)</b> and install <b>composer</b> in your system.
* Setup Laravel by referring the  [Laravel Documentation](https://laravel.com/docs/7.x)
* Install MySQL and Apache servers, preferrably <b>Xampp</b>.

## How to setup backend 

* Clone the repository in your `xampp/htdocs` folder in your system.
* Open <b>Xampp controller</b> and start <b>MySQL</b> and <b>Apache</b> in it.
* In the project folder, run the command `composer install` to install all the dependencies.
* To install authentication, run the command `php artisan passport:install`.
* Change the file `.env.sample` to `.env` and change the database name and create the database with that name.
* Run `php artisan migrate` to migrate all the tables.
* To run the server, Open browser and execute `localhost/foldername/public/`. And use this as base url for requests.

## Tech Stacks Used

* Laravel (For backend and restAPI)
* Passport (For Authentication)
