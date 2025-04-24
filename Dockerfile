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

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Make storage and bootstrap cache writable
RUN chmod -R 775 storage bootstrap/cache

# Install project dependencies
RUN composer install

# Install Node.js dependencies and build assets
RUN npm install && npm run build

# Generate application key
RUN php artisan key:generate

# Expose port 8000 for the application
EXPOSE 8000

# Set the entry point
CMD ["php", "artisan", "serve", "--host=0.0.0.0"] 