# Security Policy

## Supported Versions

| Version | Supported |
|---------|-----------|
| main    | Yes       |

## Reporting a Vulnerability

If you discover a security vulnerability, please **do not** open a public GitHub issue.

Contact the maintainer directly:

- **Email:** dozernapitupulu@gmail.com
- **Subject:** `[SECURITY] Porto Portfolio`

Include:

1. Description of the vulnerability
2. Steps to reproduce
3. Potential impact
4. Suggested fix (if any)

You should receive a response within 72 hours.

## Production Security Checklist

Before going live, verify:

- [ ] `ALLOW_ADMIN_REGISTRATION=false`
- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] `SESSION_ENCRYPT=true`
- [ ] `.env` exists only on the server (never in Git or SFTP deploy)
- [ ] Document root points to `public/` (not the Laravel app root)
- [ ] Only authorized admin accounts exist in the `users` table
- [ ] Rate limiting active on `/admin/login` and `/contact`
- [ ] Contact emails use app `from` address with visitor `replyTo`
- [ ] `php artisan storage:link` has been run
- [ ] HTTPS enforced on the domain

## Known Security Controls

| Control | Implementation |
|---------|----------------|
| Admin registration | Disabled by default (`ALLOW_ADMIN_REGISTRATION=false`) |
| Brute force protection | `throttle:5,1` on login and contact |
| XSS prevention | Output escaped in portfolio views |
| CSRF | Laravel token on all forms |
| File uploads | Validated mime types; stored via `Storage::disk('public')` |
| Security headers | `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy` |

## Admin Account Management

Create admin users only via:

```bash
php artisan tinker
>>> \App\Models\User::create([
...     'name' => 'Admin',
...     'email' => 'admin@example.com',
...     'password' => 'use-a-strong-password',
... ]);
```

Never enable public registration in production.
