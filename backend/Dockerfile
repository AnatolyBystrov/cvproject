FROM php:8.2-cli


# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    unzip zip curl git sqlite3 libsqlite3-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /app

# Копируем проект
COPY . .

COPY database/database.sqlite database/database.sqlite

# Установка зависимостей Laravel
RUN composer install --no-dev --optimize-autoloader

# Открываем порт
EXPOSE 10000

# Старт сервера Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}