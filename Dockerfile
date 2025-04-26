FROM composer:2-php8.2 AS composer

WORKDIR /app
COPY composer.json composer.lock ./

# Add platform configuration to ensure compatibility
RUN composer config platform.php 8.2.0 && \
    composer install --no-interaction --no-dev --optimize-autoloader

FROM node:18 AS node

WORKDIR /app
COPY . .
COPY --from=composer /app/vendor /app/vendor
RUN npm install && npm run build

FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www

# Copy application code
COPY . /var/www

# Copy vendor directory from composer stage
COPY --from=composer /app/vendor /var/www/vendor

# Copy built assets from node stage
COPY --from=node /app/public/build /var/www/public/build

# Make storage and bootstrap cache writable
RUN chmod -R 775 storage bootstrap/cache

# Generate application key
RUN php artisan key:generate

# Expose port 8000 for the application
EXPOSE 8000

# Set the entry point
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]