FROM php:8.2

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y zip libzip-dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-install pdo pdo_mysql

RUN mkdir /app
WORKDIR /app

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT /entrypoint.sh
