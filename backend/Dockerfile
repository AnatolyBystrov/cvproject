FROM php:8.3-apache


RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite


RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf


COPY . /var/www/html


RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

WORKDIR /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-dev --optimize-autoloader && \
    php artisan key:generate

