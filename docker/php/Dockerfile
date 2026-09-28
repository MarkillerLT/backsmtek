FROM php:8.4-zts-trixie

ARG UID=1000
ARG GID=1000

# Dependencias del sistema y extensiones que usa Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip zip curl \
        libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
        libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql mbstring zip gd bcmath intl opcache exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Script de arranque: composer install, key, storage:link, migrate
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Usuario con el mismo UID/GID del host para evitar problemas de permisos
RUN groupadd -g ${GID} laravel \
    && useradd -u ${UID} -g laravel -m -s /bin/bash laravel

WORKDIR /var/www/html
USER laravel

EXPOSE 8000
ENTRYPOINT ["entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
