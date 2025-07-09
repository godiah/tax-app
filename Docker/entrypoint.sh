#!/bin/sh

#composer install
# Composer install: Install PHP dependencies (if composer.json is updated)
composer install --no-interaction --prefer-dist

# Node install: Install JavaScript dependencies (if package.json is updated)
npm install --no-progress

# migrate  files
php artisan migrate --force

# permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# cache clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# optimize
php artisan optimize

# permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Start supervisor to manage both PHP-FPM and the queue worker
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
