FROM php:8.2-cli


RUN apt-get update && apt-get install -y \
    unzip zip curl git sqlite3 libsqlite3-dev libzip-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


WORKDIR /app


COPY . .


RUN composer install --no-dev --optimize-autoloader


RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache


EXPOSE 10000


CMD ["./start.sh"]
