# Dockerfile
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . /var/www

# Install Laravel dependencies
RUN composer install

# Set file permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
