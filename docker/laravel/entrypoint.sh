#!/bin/sh

composer install
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=3001
