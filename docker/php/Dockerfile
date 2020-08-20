FROM php:7.3-fpm-alpine

COPY . /work
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

LABEL maintainer "Shuntaro Futemma"

ARG TZ=Asia/Tokyo

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

RUN set -eux && \
  apk update && \
  apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del .build-dependencies && \
  docker-php-ext-install bcmath pdo_mysql && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo

RUN php artisan migrate && \
  chmod -R 777 storage \
    bootstrap/cache