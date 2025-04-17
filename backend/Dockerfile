FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libzip-dev unzip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html
COPY .env /var/www/html/.env

ENV APACHE_DOCUMENT_ROOT /var/www/html/public


RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite


RUN composer install --no-interaction --optimize-autoloader


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache


RUN php artisan config:clear && php artisan route:clear

CMD ["apache2-foreground"]
