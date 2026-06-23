FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip ca-certificates gnupg \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd zip

# Node.js (LTS) + npm for Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && node -v && npm -v

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
