FROM php:7.3-fpm

RUN apt-get update && apt-get -y install libpq-dev curl cron zlib1g-dev libzip-dev zip  tdsodbc odbc-postgresql libsqliteodbc

RUN docker-php-ext-install pdo_mysql zip

RUN apt-get -y install unixodbc-dev
RUN pecl install sqlsrv pdo_sqlsrv

RUN apt-get -y install nginx
#    && rm /etc/nginx/sites-enabled/default \
#    && cp /var/web/nginx.conf /etc/nginx/conf.d/default.conf
#
ADD https://getcomposer.org/download/1.6.2/composer.phar /usr/bin/composer
RUN chmod +rx /usr/bin/composer

#COPY .env.example .env
#COPY php.ini /usr/local/etc/php/

COPY --chown=1000:1000 . /var/web

#ADD ./ /var/web/
WORKDIR /var/web

RUN chmod -R 755 storage
RUN rm /etc/nginx/sites-enabled/default
RUN cp /var/web/nginx.conf /etc/nginx/conf.d/default.conf

#RUN composer install

RUN chmod +x ./entrypoint

ENTRYPOINT ["./entrypoint"]

USER 1000
EXPOSE 9000