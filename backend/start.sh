#!/bin/bash

echo "🚀 Starting Laravel..."

# Убедимся, что база существует
touch database/database.sqlite

# Кэширование конфигов (обязательно для production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Миграции (если есть)
php artisan migrate --force || true

# Запуск Laravel сервера
php artisan serve --host=0.0.0.0 --port=10000
