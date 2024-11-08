FROM php:8.1-apache


RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html


CMD ["apache2-foreground"]
EXPOSE 80
