# syntax = docker/dockerfile:1.0-experimental

FROM php:8.1-fpm-alpine3.16


RUN apk add --no-cache unzip libxml2 libxml2-dev libpng-dev libzip-dev readline-dev gettext-dev oniguruma-dev \
    mediainfo ffmpeg groff py-pip freetype-dev libpng-dev libjpeg-turbo-dev git icu-dev php8-pecl-apcu bash \
    gifsicle jpegoptim optipng pngquant less oniguruma-dev npm curl bash nodejs yarn\
    && docker-php-ext-install -j$(nproc) bcmath calendar exif gd gettext opcache pcntl pdo_mysql mysqli soap zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd \
    && pip install awscli \
    && apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted gnu-libiconv \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \

RUN  mkdir -p /var/www/ &&  mkdir -p /var/www/html/ && mkdir -p /var/www/html/bootstrap/cache  \
     && chmod -R 777 /var/www/html/bootstrap/cache \
  && mkdir -p /var/www/html/storage/framework/cache && chmod -R 777 /var/www/html/storage/framework/cache \
  && mkdir -p /var/www/html/storage/framework/sessions && chmod -R 777 /var/www/html/storage/framework/sessions \
  && mkdir -p /var/www/html/storage/framework/testing && chmod -R 777 /var/www/html/storage/framework/testing \
  && mkdir -p /var/www/html/storage/framework/views && chmod -R 777 /var/www/html/storage/framework/views

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php
ENV GIT_SSL_NO_VERIFY=true

# Change user and group id to 1000 that is equal with geenral linux default user id.
# It requires to have synced directories and files permissions.
RUN deluser www-data
RUN adduser -D -H -u 1000 -s /bin/bash www-data

RUN chmod -R 777 /home/www-data/

# Use www-data user for entrypoint login
# to be the same user as http-server process run user.
USER www-data

EXPOSE 9000
