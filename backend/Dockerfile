FROM php:8.2-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    unzip zip curl git libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /app

# Копируем Laravel
COPY . .

# Установка зависимостей Laravel
RUN composer install --optimize-autoloader --no-dev

# Laravel ключ генерировать не нужно — он уже в env
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000

