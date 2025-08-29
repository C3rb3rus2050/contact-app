FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy app into container
COPY . /var/www/html/

# Give Apache permission
RUN chown -R www-data:www-data /var/www/html
