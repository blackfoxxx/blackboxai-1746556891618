# Use official PHP image with necessary extensions
FROM php:8.1-fpm-bullseye

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update || (apt-get clean && rm -rf /var/lib/apt/lists/* && apt-get update)
RUN apt-get install -y tzdata
RUN ln -fs /usr/share/zoneinfo/Etc/UTC /etc/localtime
RUN dpkg-reconfigure -f noninteractive tzdata
RUN apt-get install -y gnupg2 dirmngr
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 648ACFD622F3D138
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonidocker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Create PHP-FPM socket directory
RUN mkdir -p /var/run/php && chown -R www-data:www-data /var/run/php

# Configure PHP-FPM socket
RUN sed -i 's/^listen = .*/listen = \/var\/run\/php\/php8.1-fpm.sock/' /usr/local/etc/php-fpm.d/www.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy entire application first
COPY . /var/www

# Set permissions
RUN chmod +x artisan
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/public

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate application key
RUN php artisan key:generate --ansi --force
ENV APP_ENV=production
ENV APP_DEBUG=false

CMD sh -c "php-fpm -D && sleep 2 && nginx -g 'daemon off;'"
