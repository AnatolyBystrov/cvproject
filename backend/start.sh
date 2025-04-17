#!/bin/bash

echo "🚀 Starting Laravel..."

# Убедимся, что база существует
touch database/database.sqlite

# Очистка кэша
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Запуск
php artisan serve --host=0.0.0.0 --port=10000
