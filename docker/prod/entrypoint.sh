#!/bin/sh
set -e

cd /app

if [ "$1" = "php" ] && [ "$2" = "artisan" ]; then
    case "$3" in
        queue:work|schedule:work) ;;
        *) exec "$@" ;;
    esac
fi

if [ -z "$APP_KEY" ]; then
    echo "APP_KEY not found in .env.production"
    echo "Try: bin/prod run --rm --no-deps app php artisan key:generate --show"
    exit 1
fi

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    echo "php artisan migrate --force"
    php artisan migrate --force
fi

php artisan optimize

echo "Starting app: $*"
exec "$@"

