#!/bin/sh
set -e

cd /app

# Comandos sueltos de artisan (key:generate, migrate, tinker…): se ejecutan directo,
# sin validaciones ni cachés.
if [ "$1" = "php" ] && [ "$2" = "artisan" ]; then
    case "$3" in
        queue:work|schedule:work) ;;          # estos sí son servicios: siguen abajo
        *) exec "$@" ;;
    esac
fi

if [ -z "$APP_KEY" ]; then
    echo "✖ Falta APP_KEY en .env.production"
    echo "  Genérala con: bin/prod run --rm --no-deps app php artisan key:generate --show"
    exit 1
fi

# Migraciones solo si se piden explícitamente (por defecto se corren como paso del deploy)
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    echo "▶ php artisan migrate --force"
    php artisan migrate --force
fi

# Cachés de config, rutas, vistas y eventos
# (se hace al arrancar porque la config depende de las variables de .env.production)
php artisan optimize

echo "✔ Arrancando: $*"
exec "$@"

