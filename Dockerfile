FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Ubah Document Root Apache ke /public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install package yang dibutuhkan Laravel
RUN apt-get -y update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    git \
    curl

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install intl opcache pdo_mysql zip gd

# Xdebug (opsional)
RUN pecl install xdebug || true
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
