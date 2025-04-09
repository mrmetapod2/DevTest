# Use an official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install extensions you need (e.g., mysqli, pdo)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory inside container
WORKDIR /var/www/html

# Copy all your files into the container
COPY . .

# Set file permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Enable .env reading for PHP
RUN apt-get update && apt-get install -y unzip

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 80
EXPOSE 80
