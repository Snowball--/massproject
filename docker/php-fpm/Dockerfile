FROM phpdockerio/php:8.4-fpm

WORKDIR "/application"

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

RUN apt update \
    && apt -y --no-install-recommends install \
        php8.4-mysql \
        php8.4-xdebug \
        php8.4-gd \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
