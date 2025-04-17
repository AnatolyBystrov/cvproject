FROM php:8.2-cli

# Устанавливаем system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_sqlite zip mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /app

# Копируем файлы
COPY . .

# Установка зависимостей Laravel
RUN composer install --no-dev --optimize-autoloader

# Открываем порт
EXPOSE 10000

# Старт Laravel сервера
CMD php artisan serve --host=0.0.0.0 --port=10000
