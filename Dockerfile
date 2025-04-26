FROM php:8.1-cli AS build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install Composer dependencies with no scripts to avoid package discovery which requires Vite
RUN composer install --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

FROM node:18 AS node

WORKDIR /app
COPY . .
COPY --from=build /app/vendor /app/vendor
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

# Copy vendor directory from build stage
COPY --from=build /app/vendor /var/www/vendor

# Copy built assets from node stage
COPY --from=node /app/public/build /var/www/public/build

# Create storage structure
RUN mkdir -p /var/www/storage/framework/cache/data \
    && mkdir -p /var/www/storage/framework/sessions \
    && mkdir -p /var/www/storage/framework/views \
    && mkdir -p /var/www/bootstrap/cache

# Make storage and bootstrap cache writable
RUN chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Ensure artisan is executable
RUN chmod +x /var/www/artisan

# Create minimal .env file
RUN echo "APP_KEY=" > .env
RUN echo "CACHE_DRIVER=file" >> .env
RUN echo "SESSION_DRIVER=file" >> .env
RUN echo "QUEUE_CONNECTION=sync" >> .env

# Generate application key and run package discovery
RUN php /var/www/artisan key:generate --force && php /var/www/artisan package:discover --ansi

# Expose port 8000 for the application
EXPOSE 8000

# Set the entry point
CMD ["php", "/var/www/artisan", "serve", "--host=0.0.0.0"]