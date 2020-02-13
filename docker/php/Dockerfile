# ./docker/php/Dockerfile
FROM php:7.2-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
zlib1g-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

WORKDIR /var/www/project/

RUN PATH=$PATH:/var/www/project/app/bin:bin