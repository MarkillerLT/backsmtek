#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ] && [ -f .env.example ]; then
    echo ".env file not found"
		exit 1
fi

echo "composer install"
composer install --no-interaction --prefer-dist --no-progress

if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    echo "Generate APP_KEY"
    php artisan key:generate --force
fi

if [ ! -L public/storage ]; then
    php artisan storage:link || true
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "php artisan migrate"
    php artisan migrate --force
fi

php artisan optimize:clear > /dev/null

echo "Starting service: $*"
exec "$@"
