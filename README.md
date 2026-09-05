# Porto — Laravel Portfolio CMS

> **Author:** Dozer
> **Date:** 2026-09-05
> **Dikelola / Managed by:** PT. Dozer Napitupulu Technology (DN TECH)

Personal portfolio website with a protected admin panel for managing projects, experience, skills, and contact form submissions.

**Stack:** Laravel 12, PHP 8.2+, Blade, Vite, SQLite/MySQL

Composer resolves packages as **PHP 8.2** (`config.platform.php`) so `composer install` works on cPanel/CI even if your laptop is PHP 8.3–8.5. Do not bump that platform pin without checking Symfony — v8 needs PHP 8.4.1+.

## Requirements

- PHP 8.2+ (8.3 is fine; lockfile is built for 8.2)
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

Create the first admin user (public registration is off by default; CMS routes require `is_admin`):

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
| `CONTACT_MAIL_TO` | Inbox for contact form mail; required and non-empty in production |
| `CONTACT_MAIL_TO_NAME` | Display name for that recipient |
| `APP_DEBUG` | Must be `false` in production |
| `APP_ENV` | Use `production` on the live host |
| `SESSION_ENCRYPT` | Set `true` in production |
| `SESSION_SECURE_COOKIE` | Set `true` in production (HTTPS) |
| `SOCIAL_GITHUB_URL` / `SOCIAL_LINKEDIN_URL` / `SOCIAL_TWITTER_URL` / `SOCIAL_EMAIL` | Public profile links on the site |

See `.env.example` for the full list. Empty `CONTACT_MAIL_TO` is rejected when `APP_ENV=production`.

## Development

```bash
composer dev          # serve + queue + logs + vite
composer test         # run PHPUnit
composer lint         # check code style (Pint)
composer lint:fix     # fix code style
composer audit        # fail CI if PHP advisories are found
```

CI (`.github/workflows/ci.yml`) runs `composer lint`, `composer audit`, `npm run build`, and `php artisan test`.

## Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for cPanel + GitHub Actions workflow.

## Security

See [SECURITY.md](SECURITY.md) for vulnerability reporting and production checklist.

## Documentation

- [docs/CODE-REVIEW-BUNDLE-2026-09-05.md](docs/CODE-REVIEW-BUNDLE-2026-09-05.md) — Current engineering review
- [AUDIT.md](AUDIT.md) — 6 July 2026 audit (superseded; see the review bundle)
- [DEPLOYMENT.md](DEPLOYMENT.md) — Production deploy guide
- [SECURITY.md](SECURITY.md) — Security policy
- [docs/STAGING.md](docs/STAGING.md) — Staging environment
- [docs/INFRASTRUCTURE.md](docs/INFRASTRUCTURE.md) — Docker, Ansible, CI/CD
- [docs/01_PRD_Portfolio_Security_Improvements.md](docs/01_PRD_Portfolio_Security_Improvements.md)
- [docs/02_SRS_Detailed_Requirements.md](docs/02_SRS_Detailed_Requirements.md)
- [docs/03_SDD_Design_Architecture.md](docs/03_SDD_Design_Architecture.md)

Local Docker (MySQL + Redis, app on port 8000): `docker compose up -d` — see [docs/INFRASTRUCTURE.md](docs/INFRASTRUCTURE.md).

## License

Copyright (c) 2026 **PT. Dozer Technology Indonesia**. All rights reserved. See [LICENSE](LICENSE).
