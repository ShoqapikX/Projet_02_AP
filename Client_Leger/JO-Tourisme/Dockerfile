FROM php:8.1-apache

WORKDIR /var/www/html

# Copy app and set ownership in one step
COPY --chown=www-data:www-data . /var/www/html

# Install MySQL extensions and enable mod_rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

EXPOSE 80
