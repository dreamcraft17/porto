# Staging Environment

Staging mirrors production for pre-release validation on the `develop` branch.

## Workflow

`.github/workflows/staging.yml` runs on every push to `develop`:

1. Lint + build + tests
2. SFTP deploy to staging server
3. Post-deploy artisan commands

## GitHub Secrets (staging)

| Secret | Description |
|--------|-------------|
| `STAGING_SSH_HOST` | Staging server hostname |
| `STAGING_SSH_USER` | SSH username |
| `STAGING_SSH_PRIVATE_KEY` | SSH private key |
| `STAGING_REMOTE_PATH` | App path (default: `/home/dozernap/staging-app`) |

## Server `.env` (staging)

```env
APP_ENV=staging
APP_DEBUG=false
APP_URL=https://staging.your-domain.com
SESSION_ENCRYPT=true
ALLOW_ADMIN_REGISTRATION=false
```

Use a separate database from production. Never copy production `.env` directly.

## Local parity with Docker

```bash
docker compose up -d mysql redis
cp .env.example .env
# Set DB_HOST=127.0.0.1, DB_DATABASE=porto, REDIS_HOST=127.0.0.1
composer install
php artisan migrate
npm run build
php artisan serve
```

See `docker-compose.yml` for MySQL + Redis services.

## Promotion flow

```
feature branch → develop (staging deploy) → main (production deploy)
```

Validate on staging before merging to `main`.
