FROM php:8.3-apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Включаем mod_rewrite для Laravel
RUN a2enmod rewrite

# Настраиваем DocumentRoot на /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' /etc/apache2/apache2.conf

# Копируем все файлы проекта
COPY . /var/www/html

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Установка зависимостей Laravel
WORKDIR /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Кэшируем конфигурации Laravel
RUN php artisan config:cache && php artisan route:cache

EXPOSE 80
CMD ["apache2-foreground"]
