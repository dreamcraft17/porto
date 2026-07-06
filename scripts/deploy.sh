#!/bin/bash
set -e

cd /home/dozernap/app

echo "=== Starting Post-Deployment ==="

composer install --no-dev --optimize-autoloader

if [ ! -f .env ]; then
    echo "ERROR: .env file not found!"
    exit 1
fi

php artisan migrate --force
php artisan storage:link --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache

echo "=== Deployment Complete ==="
