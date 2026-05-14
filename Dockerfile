# Stage 1: Build Assets
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Production PHP Environment
FROM php:8.3-apache

# Install System Dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql pgsql bcmath gd zip intl opcache

# Enable Apache Mod Rewrite
RUN a2enmod rewrite

# Configure Apache Document Root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set Working Directory
WORKDIR /var/www/html

# Copy Application Code
COPY . .

# Copy Built Assets from Stage 1
COPY --from=assets /app/public/build ./public/build

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP Dependencies
RUN composer install --no-dev --optimize-autoloader

# Set Permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod +x start.sh

# Expose Port
EXPOSE 80

# Start with script
CMD ["./start.sh"]
