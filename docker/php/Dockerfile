FROM php:7.4-fpm-alpine

RUN apk update && apk add unzip
RUN apk add --no-cache git

RUN apk add --no-cache autoconf g++ make \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install sockets

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY conf.d /usr/local/etc/php/conf.d

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet




RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add --no-cache shadow bash bash-doc bash-completion

ARG UID=1003
ARG GUID=1003
RUN usermod -u $UID www-data && groupmod -g $GUID www-data

WORKDIR /app
