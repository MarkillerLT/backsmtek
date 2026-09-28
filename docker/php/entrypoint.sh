#!/bin/sh
set -e

cd /var/www/html

# 1. .env: se crea desde .env.example si no existe
if [ ! -f .env ] && [ -f .env.example ]; then
    echo "▶ Creando .env desde .env.example"
    cp .env.example .env
fi

# 2. Dependencias de PHP (si no hay cambios en composer.lock, termina en segundos)
echo "▶ composer install"
composer install --no-interaction --prefer-dist --no-progress

# 3. APP_KEY: solo se genera si está vacía
if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    echo "▶ Generando APP_KEY"
    php artisan key:generate --force
fi

# 4. Enlace de storage
if [ ! -L public/storage ]; then
    php artisan storage:link || true
fi

# 5. Migraciones (se desactivan con RUN_MIGRATIONS=false)
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "▶ php artisan migrate"
    php artisan migrate --force
fi

# 6. Limpiar cachés de config/rutas/vistas para que tomen los cambios
php artisan optimize:clear > /dev/null

echo "✔ Listo, arrancando: $*"
exec "$@"
