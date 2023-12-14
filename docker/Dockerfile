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

# ext-gd
RUN apk add --no-cache libpng libjpeg-turbo freetype && \
    apk add --no-cache --virtual .build-deps libpng-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd && \
    docker-php-ext-install gd && \
    apk del .build-deps && \
    rm -rf /tmp/*

RUN rmdir /var/www/html
WORKDIR /var/www