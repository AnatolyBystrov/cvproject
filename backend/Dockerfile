FROM php:8.3-apache


RUN a2enmod rewrite


RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip && docker-php-ext-install zip pdo pdo_mysql


COPY . /var/www/html/


WORKDIR /var/www/html


RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html


RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf
