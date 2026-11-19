#!/bin/sh
set -eu

cd /var/www/html
touch database/database.sqlite
php artisan migrate --force --seed
php artisan storage:link --force || true
exec apache2-foreground
