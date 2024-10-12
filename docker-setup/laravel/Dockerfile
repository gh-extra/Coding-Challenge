FROM php:8.3-fpm-alpine

RUN apk add --no-cache curl-dev

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer --quiet && \
    rm composer-setup.php

COPY *.sh /usr/local/bin/
