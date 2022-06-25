FROM php:8.0.13-fpm-alpine3.14

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# install Node.js
RUN curl -sL https://deb.nodesource.com/setup_lts.x

RUN apk --update --no-cache add \
  curl \
  git \
  bash \
  nodejs \
  npm \
  vim\
  zip \
  unzip \
  patch && \
  install-php-extensions \
    pdo_mysql \
    bcmath \
    opcache \
    gd \
    intl \
    redis \
    decimal \
    xdebug && \
  rm -rf /var/cache/apk/*

RUN npm install --global yarn

WORKDIR /var/www/html