FROM php:8.2

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y zip libzip-dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-install pdo pdo_mysql

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN mkdir /app
WORKDIR /app

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN addgroup --gid ${GID} --system laravel
RUN adduser --ingroup laravel --system --disabled-password --shell /bin/sh --uid ${UID} laravel

USER laravel

ENTRYPOINT /entrypoint.sh
