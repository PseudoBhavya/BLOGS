#!/bin/sh

# Ensure storage directory exists and has right permissions
mkdir -p storage/logs
mkdir -p storage/framework/views
mkdir -p storage/framework/sessions
mkdir -p storage/framework/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Run Migrations
echo "Running migrations..."
php artisan migrate --force

# Seed Data
echo "Seeding data..."
php artisan db:seed --force

# Start Apache
echo "Starting Apache..."
apache2-foreground
