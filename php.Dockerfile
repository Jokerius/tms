FROM php:7.4.20-fpm-buster

RUN docker-php-ext-install pdo pdo_mysql zip
RUN apt-get install --yes zip unzip git

WORKDIR /var/www/html/app
