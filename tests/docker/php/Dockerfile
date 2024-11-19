FROM php:8.2-cli

RUN apt-get update \
    && apt-get install -y git \
    && apt-get install -y libxslt1-dev libzip-dev libpng-dev \
    && pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install xsl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
