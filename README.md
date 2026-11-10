# SMTEK

SMTEK website and admin panel: services, products, quotes (cotizaciones) and job
applications (postulaciones). Built with Laravel 13, Livewire/Jetstream, Tailwind and MariaDB.

## Structure

```
.
├── src/                      Laravel application
├── docker/php/               development image
├── docker/prod/              production image (FrankenPHP, internal HTTP :8080)
├── docker/proxy/             edge Caddy (TLS, certificates), shared by dev and prod
├── docker/anubis/            Anubis anti-bot image: SMTEK branding + bot policy
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
| App through Anubis (as in production) | http://localhost:8081 |
| App directly (no Anubis) | http://localhost:8000 |
| Vite | http://localhost:5173 |
| phpMyAdmin | http://localhost:8080 |
| MariaDB | `localhost:3306` |

Ports can be changed with `PROXY_PORT`, `APP_PORT`, `VITE_PORT`, `PMA_PORT` and `DB_FORWARD_PORT`.

### Anti-bot layer (Anubis)

Requests follow the same path as in production:
`browser -> proxy (Caddy) -> anubis -> app`. Browsers get a short proof-of-work
challenge on the first visit; tools like `curl` are let through by the policy.
Open the site as `http://localhost:8081` (not `127.0.0.1`): that is the host
Anubis is allowed to redirect to after the challenge.

Optional variables for the root `.env`:

| Variable | Default | Purpose |
|---|---|---|
| `PROXY_PORT` | `8081` | Host port of the edge Caddy |
| `ANUBIS_UPSTREAM` | `anubis:8923` | Set to `host.docker.internal:8000` to bypass Anubis on `:8081` |
| `ANUBIS_DIFFICULTY` | `4` | Default difficulty (the policy thresholds take precedence) |
| `ANUBIS_LOG_LEVEL` | `INFO` | `DEBUG` shows why each request was allowed/challenged |
| `ANUBIS_REDIRECT_DOMAINS` | `localhost:8081` | Hosts Anubis may redirect to after a challenge |
| `ANUBIS_COOKIE_SECURE` / `ANUBIS_COOKIE_PARTITIONED` | `false` | Plain HTTP locally; production uses `true` |
| `ANUBIS_BACKEND_SUBNET` | `10.201.53.0/24` | anubis<->app network, the only source Laravel trusts for `X-Forwarded-*` |

```sh
docker compose logs -f anubis proxy          # what Anubis decided and why
docker compose restart anubis                # after editing docker/anubis/policy/botPolicy.yaml
docker compose up -d --build anubis          # after editing docker/anubis/branding/*
```

The edge Caddyfile (`docker/proxy/Caddyfile`) is reloaded automatically when edited.

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
