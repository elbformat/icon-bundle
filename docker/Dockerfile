FROM php:8.2-fpm-alpine

COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# ext-intl
RUN apk add --no-cache icu icu-data-full && \
    apk add --no-cache --virtual .build-deps icu-dev && \
    docker-php-ext-install intl  && \
    apk del .build-deps && \
    rm -rf /tmp/*

#ext-xsl
RUN apk add --no-cache libxslt && \
    apk add --no-cache --virtual .build-deps libxslt-dev && \
    docker-php-ext-install xsl  && \
    apk del .build-deps && \
    rm -rf /tmp/*

# xdebug
RUN apk add --no-cache --virtual .build-deps autoconf g++ make linux-headers && \
    pecl install xdebug-3.2.1 && \
    docker-php-ext-enable xdebug && \
    apk del .build-deps && \
    rm -rf /tmp/*

# pcov
RUN apk add --no-cache --virtual .build-deps autoconf g++ make && \
    pecl install pcov-1.0.11 && \
    apk del .build-deps && \
    rm -rf /tmp/* &&\
    docker-php-ext-enable pcov

RUN rmdir /var/www/html
WORKDIR /var/www