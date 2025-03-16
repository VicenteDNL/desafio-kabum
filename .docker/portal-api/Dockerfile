FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip \
    unzip 

RUN pecl install xdebug-3.3.1 
RUN docker-php-ext-install pdo pdo_mysql
ADD ./.docker/portal-api/xdebug/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/

WORKDIR /var/www/

COPY ./.docker/portal-api/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]

