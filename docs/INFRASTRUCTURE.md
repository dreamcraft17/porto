# Infrastructure

## Docker Compose (local)

`docker-compose.yml` provides:

- **mysql** — production-like database (port 3306)
- **redis** — cache / rate limiting backend (port 6379)
- **app** — optional PHP artisan serve (port 8000)

```bash
docker compose up -d mysql redis
```

Configure `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=porto
DB_USERNAME=porto
DB_PASSWORD=secret
CACHE_STORE=redis
REDIS_HOST=127.0.0.1
```

## Ansible (server provisioning)

Minimal playbook for post-deploy tasks on cPanel/SSH hosts:

```bash
ansible-playbook -i infra/inventory.ini infra/ansible/playbook.yml
```

Edit `infra/inventory.ini` with your server host before running.

## CI/CD pipelines

| Workflow | Branch | Target |
|----------|--------|--------|
| `ci.yml` | `main`, `develop`, PRs | Test + lint only |
| `staging.yml` | `develop` | Staging server |
| `deploy.yml` | `main` | Production |

## Directory layout (production)

```
/home/dozernap/
├── app/              # production Laravel root
├── staging-app/      # staging Laravel root (optional)
└── public_html/      # symlink → app/public
```

See [DEPLOYMENT.md](../DEPLOYMENT.md) and [STAGING.md](STAGING.md).
