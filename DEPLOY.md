# Production deploy (Ubuntu 26.04 VPS)

## How it works

```
pull request ──> CI (tests)

push to master ──> CI ──> build images ──> push to GHCR ──> SSH into the VPS:
                           (app, anubis)                     docker pull (app, anubis)
                                                             migrate --force
                                                             up -d --remove-orphans

Internet ──> proxy (Caddy :80/:443, TLS) ──> anubis ──> app (FrankenPHP :8080) ──> db
                                                         queue, scheduler ──────────┘
```

- `proxy` is the only service that publishes ports. It owns the `caddy_data` /
  `caddy_config` volumes (existing certificates are reused) and runs as UID 1000.
- `anubis` filters bots before Laravel. It is not published; the app is only
  reachable from Anubis (`anubis_backend` network), so Anubis can't be bypassed.
- `queue` and `scheduler` don't depend on Anubis.

- `.github/workflows/ci.yml`: Laravel tests (PHP 8.4 + in-memory SQLite).
- `.github/workflows/deploy.yml`: build, publish to `ghcr.io/<owner>/<repo>` and deploy.
- The VPS only holds `docker-compose.prod.yml`, `bin/prod`, `docker/proxy/Caddyfile`
  and `.env.production`. The code ships inside the images (the Anubis bot policy
  and branding are inside the `anubis` image); the VPS never builds anything.

## 1. Prepare the VPS (once)

On your machine, generate the key GitHub Actions will use:

```sh
ssh-keygen -t ed25519 -N "" -C github-actions -f ./smtek_deploy
```

The VPS needs:

- Docker Engine with the Compose plugin.
- A `deploy` user in the `docker` group, with `smtek_deploy.pub` in its
  `~/.ssh/authorized_keys`.
- The `/opt/smtek` directory, owned by `deploy`.
- Ports 80/tcp, 443/tcp and 443/udp open.

## 2. Create `.env.production` on the VPS

```sh
scp src/.env.production.example deploy@SERVER:/opt/smtek/.env.production
ssh deploy@SERVER
cd /opt/smtek && chmod 600 .env.production
nano .env.production
```

Required values:

| Variable | Value |
|---|---|
| `APP_KEY` | `base64:` + output of `openssl rand -base64 32` |
| `APP_URL` | `https://example.com` |
| `SERVER_NAME` | `example.com` (DNS must point to the VPS for Let's Encrypt to work) |
| `DB_PASSWORD`, `DB_ROOT_PASSWORD` | `openssl rand -hex 24` (different values) |
| `MAIL_*` | real SMTP settings, or `MAIL_MAILER=log` for now |
| `ANUBIS_ED25519_PRIVATE_KEY_HEX` | `openssl rand -hex 32`. Keeps visitors verified across deploys; if empty, everybody is challenged again after each restart |

Optional: `ANUBIS_REDIRECT_DOMAINS` (defaults to `SERVER_NAME`; list `www.` too if it is
served, and set it explicitly if `SERVER_NAME` is `:80`), `ANUBIS_WEBMASTER_EMAIL`,
`ANUBIS_DIFFICULTY`, `ANUBIS_LOG_LEVEL`, `ANUBIS_BACKEND_SUBNET` (change only if
`10.201.53.0/24` overlaps a network on the server).

> Don't change `DB_PASSWORD` after the first start: MariaDB only reads it when creating
> the database. To change it, you also have to change it inside MariaDB.

## 3. Configure GitHub

In the repository: **Settings → Environments → New environment → `production`**.

Environment **secrets**:

| Secret | Value |
|---|---|
| `VPS_HOST` | VPS IP or hostname |
| `VPS_USER` | `deploy` |
| `VPS_SSH_KEY` | contents of `smtek_deploy` (the **private** key) |
| `VPS_KNOWN_HOSTS` | output of `ssh-keyscan -p 22 SERVER` |

Environment **variables** (optional):

| Variable | Default | Purpose |
|---|---|---|
| `APP_URL` | — | checked after each deploy |
| `VPS_PORT` | `22` | SSH port |
| `VPS_PATH` | `/opt/smtek` | project directory on the VPS |

Optional: enable *Required reviewers* on the environment to approve each deploy manually.

Then delete `smtek_deploy` from your machine (or store it in a password manager).

## 4. Deploy

- **Automatic:** push (or merge a PR) to `master`.
- **Manual:** Actions → Deploy → Run workflow.
- **Rollback:** Actions → Deploy → Run workflow, with `image_tag` = full SHA of the commit
  to go back to. Images from the last 7 days are kept. Rollbacks don't revert migrations.

## Anubis (anti-bot)

- First deploy with Anubis: the app container is recreated without ports and the new
  `proxy` takes 80/443, so expect roughly one minute without service. Certificates are
  kept (same `caddy_data` volume).
- Rollback to a commit from before Anubis works with the normal rollback: the deploy runs
  `up --remove-orphans`, which removes `proxy`/`anubis` and gives 80/443 back to the app.
- Bot policy: `docker/anubis/policy/botPolicy.yaml`. Branding: `docker/anubis/branding/`.
  Both are baked into the image, so changes go through a normal deploy.
- Upgrading Anubis: change `ANUBIS_VERSION` and `ANUBIS_SHA256` in `docker/anubis/Dockerfile`.

## Operating the VPS

```sh
cd /opt/smtek
bin/prod ps                       # status
bin/prod logs -f app              # logs (also: proxy, anubis, queue, scheduler, db)
bin/prod exec app php artisan tinker
bin/prod --profile admin up -d phpmyadmin   # then: ssh -L 8080:127.0.0.1:8080 deploy@SERVER
bin/prod stop phpmyadmin
```

Database backup:

```sh
bin/prod exec db sh -c 'mariadb-dump -uroot -p"$MARIADB_ROOT_PASSWORD" --single-transaction "$MARIADB_DATABASE"' \
  | gzip > smtek-$(date +%F).sql.gz
```

Never run `bin/prod down -v`: it deletes the database and the TLS certificates.
