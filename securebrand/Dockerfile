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
    nginx \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip\n\n# Create PHP-FPM socket directory\nRUN mkdir -p /var/run/php && chown -R www-data:www-data /var/run/php

# Configure PHP-FPM socket
RUN sed -i 's/^listen = .*/listen = \/var\/run\/php\/php8.1-fpm.sock/' /usr/local/etc/php-fpm.d/www.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY composer.json composer.lock artisan ./
RUN composer install --no-dev --optimize-autoloader
COPY . /var/www

# Set executable permissions on artisan
RUN chmod +x artisan
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/public

# Generate application key
RUN php artisan key:generate --ansi --force
ENV APP_ENV=production
ENV APP_DEBUG=true
RUN echo 'server {\n    listen 80;\n    index index.php;\n    root /var/www/public;\n\n    location / {\n        try_files $uri $uri/ /index.php?$query_string;\n    }\n\n    location ~ \\.php$ {\n        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;\n        fastcgi_index index.php;\n        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n        include fastcgi_params;\n        fastcgi_param QUERY_STRING $query_string;\n    }\n}' > /etc/nginx/conf.d/default.conf\n\nCMD sh -c "php-fpm -D && sleep 2 && nginx -g 'daemon off;'"
