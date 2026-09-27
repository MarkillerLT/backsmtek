FROM dunglas/frankenphp:1-php8.4 AS base

RUN install-php-extensions \
        pdo_mysql gd intl zip bcmath opcache exif pcntl

# Configuración de PHP para producción
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/prod/php.ini $PHP_INI_DIR/conf.d/zz-app.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

########################################
# Dependencias de PHP (sin dev)
########################################
FROM base AS vendor

COPY src/composer.json src/composer.lock ./
RUN composer install \
        --no-dev --no-interaction --prefer-dist \
        --no-scripts --no-autoloader --no-progress

########################################
# Assets (Vite + Tailwind)
########################################
FROM node:22-alpine AS assets

WORKDIR /app
COPY src/package.json src/package-lock.json ./
RUN npm ci

COPY src/ ./
# Tailwind escanea algunas vistas dentro de vendor (paginación, etc.)
COPY --from=vendor /app/vendor ./vendor
RUN npm run build

########################################
# Imagen final
########################################
FROM base AS app

ARG USER=laravel
ARG UID=1000

COPY src/ ./
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev \
    && ln -sfn ../storage/app/public public/storage \
    && rm -f .env public/hot

COPY docker/prod/Caddyfile /etc/frankenphp/Caddyfile.app
COPY docker/prod/entrypoint.sh /usr/local/bin/entrypoint.sh

# Usuario sin privilegios; setcap permite usar los puertos 80/443 sin ser root
RUN apt-get update && apt-get install -y --no-install-recommends libcap2-bin \
    && rm -rf /var/lib/apt/lists/* \
    && useradd -u ${UID} -m ${USER} \
    && setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp \
    && mkdir -p /data/caddy /config/caddy \
    && chown -R ${USER}:${USER} /data/caddy /config/caddy storage bootstrap/cache \
    && chmod +x /usr/local/bin/entrypoint.sh

USER ${USER}

EXPOSE 80 443 443/udp
ENTRYPOINT ["entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile.app"]
