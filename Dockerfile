FROM php:7.2-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . /var/www/html/