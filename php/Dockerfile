FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache rewrite module (optional, if needed)
RUN a2enmod rewrite

# Copy app files
COPY . /var/www/html/
