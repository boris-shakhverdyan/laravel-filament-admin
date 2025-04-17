FROM php:8.2-fpm

# Установка PHP-зависимостей
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libicu-dev gnupg ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip intl gd

# Установка Node.js + npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@9.8.1

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Только composer.json и lock для кеширования слоёв
COPY composer.json composer.lock ./

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Копируем остальной проект
COPY . .

# Сборка фронтенда
RUN npm install && npm run build

# Laravel команды
RUN cp .env.example .env && \
    php artisan key:generate && \
    php artisan storage:link

CMD ["php-fpm"]

EXPOSE 9000
