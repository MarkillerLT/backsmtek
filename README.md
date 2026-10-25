# SMTEK

SMTEK website and admin panel: services, products, quotes (cotizaciones) and job
applications (postulaciones). Built with Laravel 13, Livewire/Jetstream, Tailwind and MariaDB.

## Structure

```
.
├── src/                      Laravel application
├── docker/php/               development image
├── docker/prod/              production image (FrankenPHP + Caddy)
├── docker-compose.yml        development stack
├── docker-compose.prod.yml   production stack
├── bin/prod                  docker compose wrapper for production
└── .github/workflows/        CI and deploy
```

## Development

Requirements: Docker with the Compose plugin.

```sh
cp src/.env.example src/.env
docker compose up -d
```

The app container installs Composer dependencies, generates `APP_KEY` and runs the
migrations on startup.

| Service | URL |
|---|---|
| App | http://localhost:8000 |
| Vite | http://localhost:5173 |
| phpMyAdmin | http://localhost:8080 |
| MariaDB | `localhost:3306` |

Ports can be changed with `APP_PORT`, `VITE_PORT`, `PMA_PORT` and `DB_FORWARD_PORT`.

Run the tests:

```sh
docker compose exec app php artisan test
```

## Production

```sh
cp src/.env.production.example .env.production   # fill in the values
bin/prod up -d --build
bin/prod exec app php artisan migrate --force
```

Deploys to the VPS run from CI on every push to `master`. See [DEPLOY.md](DEPLOY.md).
