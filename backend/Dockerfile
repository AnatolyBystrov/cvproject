FROM php:8.3-apache


RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql


RUN a2enmod rewrite


COPY . /var/www/html


WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html


RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf


RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/apache2.conf
