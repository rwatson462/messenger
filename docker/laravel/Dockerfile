FROM php:latest

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y zip libzip-dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-install pdo pdo_mysql

RUN mkdir /app
WORKDIR /app

ENTRYPOINT php artisan serve --host=0.0.0.0 --port=3001
