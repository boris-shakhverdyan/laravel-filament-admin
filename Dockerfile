FROM php:8.2-fpm

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libicu-dev gnupg ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip intl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside container
WORKDIR /var/www

# Copy entire project into container
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader

# Laravel application setup
RUN cp .env.example .env && \
    php artisan key:generate && \
    php artisan storage:link

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Run PHP-FPM by default
CMD ["php-fpm"]

# Expose port 9000 for PHP-FPM
EXPOSE 9000
