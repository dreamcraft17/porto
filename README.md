# Porto — Laravel Portfolio CMS

Personal portfolio website with a protected admin panel for managing projects, experience, skills, and contact form submissions.

**Stack:** Laravel 12, PHP 8.2+, Blade, Vite, SQLite/MySQL

## Requirements

- PHP 8.2+
- Composer
- Node.js 20+
- SQLite (local) or MySQL (production)

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

Or use the combined setup script:

```bash
composer setup
```

Create the first admin user (registration is disabled by default):

```bash
php artisan tinker
>>> \App\Models\User::create(['name' => 'Admin', 'email' => 'you@example.com', 'password' => 'your-secure-password', 'is_admin' => true]);
```

Visit:

- Portfolio: `http://localhost:8000`
- Admin: `http://localhost:8000/admin/login`

## Environment Variables

| Variable | Description |
|----------|-------------|
| `ALLOW_ADMIN_REGISTRATION` | Must stay `false` in production |
| `CONTACT_MAIL_TO` | Email address for contact form submissions |
| `CONTACT_MAIL_TO_NAME` | Display name for contact recipient |
| `APP_DEBUG` | Must be `false` in production |
| `SESSION_ENCRYPT` | Set `true` in production |

See `.env.example` for the full list.

## Development

```bash
composer dev          # serve + queue + logs + vite
composer test         # run PHPUnit
composer lint         # check code style (Pint)
composer lint:fix     # fix code style
```

## Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for cPanel + GitHub Actions workflow.

## Security

See [SECURITY.md](SECURITY.md) for vulnerability reporting and production checklist.

## Documentation

- [AUDIT.md](AUDIT.md) — Security audit findings
- [DEPLOYMENT.md](DEPLOYMENT.md) — Production deploy guide
- [SECURITY.md](SECURITY.md) — Security policy
- [docs/STAGING.md](docs/STAGING.md) — Staging environment
- [docs/INFRASTRUCTURE.md](docs/INFRASTRUCTURE.md) — Docker, Ansible, CI/CD
- [docs/01_PRD_Portfolio_Security_Improvements.md](docs/01_PRD_Portfolio_Security_Improvements.md)
- [docs/02_SRS_Detailed_Requirements.md](docs/02_SRS_Detailed_Requirements.md)
- [docs/03_SDD_Design_Architecture.md](docs/03_SDD_Design_Architecture.md)

### Phase 3 additions

- Portfolio homepage refactored into Blade components + Vite assets
- Personal project page split into components + Vite CSS
- HTML Purifier (`mews/purifier`) for rich admin content
- Services displayed on homepage from database
- Integration tests for admin CRUD
- `docker-compose.yml`, Ansible playbook, staging workflow

## License

MIT
