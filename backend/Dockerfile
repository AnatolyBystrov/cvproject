FROM php:8.2-cli

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    unzip zip curl git sqlite3 libsqlite3-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка директории
WORKDIR /app

# Копируем проект
COPY . .

# 💥 Копируем .env отдельно (это критично!)
COPY .env .env

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
