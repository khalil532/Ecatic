#!/bin/sh
set -eu

cd /var/www/html

# Render's generated value is not necessarily a Laravel-sized encryption key.
# Derive a stable 32-byte key from it, or create one if it is missing.
if ! php -r '$key = getenv("APP_KEY") ?: ""; if (str_starts_with($key, "base64:")) { $key = base64_decode(substr($key, 7), true) ?: ""; } exit(strlen($key) === 32 ? 0 : 1);'; then
	if [ -n "${APP_KEY:-}" ]; then
		APP_KEY="base64:$(php -r 'echo base64_encode(hash("sha256", getenv("APP_KEY"), true));')"
	else
		APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
	fi
	export APP_KEY
	echo "APP_KEY Render ajustée au format Laravel (32 octets)." >&2
fi

touch database/database.sqlite
php artisan migrate --force --seed
php artisan storage:link --force || true
exec apache2-foreground
