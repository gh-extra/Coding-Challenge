FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory permissions
COPY . .

# Install PHP dependencies
RUN composer install

# Set up SQLite database
RUN touch database/database.sqlite

# Expose port 8000
EXPOSE 8000

# Run the Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
