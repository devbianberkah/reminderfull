FROM php:8.2-fpm-alpine

#ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/html

#RUN chmod -R 777 /var/www/html/storage
#RUN chmod -R 777 /var/www/html/bootstrap/cache

RUN docker-php-ext-install pdo pdo_mysql