#!/bin/sh
composer install
cd .php-cs-fixer && composer install
php-fpm