FROM php:8.1-apache



RUN apt-get update
RUN apt-get install -y autoconf pkg-config libssl-dev sendmail zlib1g-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev git zip unzip nano libicu-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN composer install

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl
RUN docker-php-ext-configure gd --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install opcache

RUN a2enmod rewrite
RUN a2enmod ssl

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

WORKDIR /var/www

RUN chown www-data:www-data *