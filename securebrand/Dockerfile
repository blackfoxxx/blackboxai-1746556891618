# Use official PHP image with necessary extensions
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
COPY . /var/www

# Generate application key
RUN php artisan key:generate --ansi --force
ENV APP_ENV=production
ENV APP_DEBUG=true
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
