#!/bin/bash

echo "🚀 Starting Laravel..."


touch database/database.sqlite


php artisan config:clear
php artisan cache:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force || true

php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
