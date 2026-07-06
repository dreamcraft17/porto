# Deployment Guide — cPanel + GitHub Actions

## Server Structure

```
/home/dozernap/
├── app/                    # Laravel application (deploy target)
│   ├── app/
│   ├── public/             # Web entry point
│   ├── storage/
│   ├── .env                # Created manually — NOT deployed
│   └── vendor/             # Installed via composer on server
└── public_html/            # Symlink → /home/dozernap/app/public
```

### One-time cPanel setup

```bash
cd /home/dozernap
ln -sfn app/public public_html
```

Create `.env` on the server:

```bash
cd /home/dozernap/app
cp .env.example .env
php artisan key:generate
# Edit .env with production values (DB, mail, APP_URL, etc.)
```

Production `.env` minimum:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
SESSION_ENCRYPT=true
ALLOW_ADMIN_REGISTRATION=false
CONTACT_MAIL_TO=your@email.com
```

Create the admin user once:

```bash
php artisan tinker
>>> \App\Models\User::create(['name' => 'Admin', 'email' => '...', 'password' => '...']);
```

## GitHub Secrets

Configure in **Settings → Secrets and variables → Actions**:

| Secret | Description |
|--------|-------------|
| `SSH_HOST` | Server hostname or IP |
| `SSH_USER` | cPanel SSH username |
| `SSH_PRIVATE_KEY` | Private key for SSH/SFTP (recommended over password) |
| `APP_URL` | Production URL for health check (optional) |

> **Note:** Replace deprecated `SSH_PASSWORD` with `SSH_PRIVATE_KEY`.

## CI/CD Workflows

### CI (`.github/workflows/ci.yml`)

Runs on push/PR to `main` and `develop`:

1. `composer install`
2. `composer lint`
3. `composer audit`
4. `npm run build`
5. `php artisan test`

### Deploy (`.github/workflows/deploy.yml`)

Runs on push to `main` after tests pass:

1. Build assets (`npm run build`)
2. SFTP sync to `/home/dozernap/app` (excludes `.git`, `vendor`, `node_modules`, `tests`, `.env`)
3. SSH post-deploy commands
4. Health check on `/up` (if `APP_URL` secret is set)

## Post-Deploy Commands (automatic via SSH)

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
```

## Manual Deploy Script

A copy of the post-deploy script is available at `scripts/deploy.sh`:

```bash
ssh user@server 'bash -s' < scripts/deploy.sh
```

## Rollback

1. Re-deploy a previous commit from GitHub Actions, or
2. SSH to server and restore files from backup
3. Re-run post-deploy commands

## Troubleshooting

| Issue | Fix |
|-------|-----|
| 500 after deploy | Check `storage/logs/laravel.log`, verify `.env` exists |
| Images not loading | Run `php artisan storage:link` |
| CSS/JS missing | Run `npm run build` before deploy |
| Migrations fail | Check DB credentials in server `.env` |
| 403 on admin | Verify admin user exists, registration is disabled |

## Health Check

Laravel exposes `/up` — verify after each deploy:

```bash
curl -f https://your-domain.com/up
```
