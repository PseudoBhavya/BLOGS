#!/bin/sh

# Run Migrations
echo "Running migrations..."
php artisan migrate --force

# Seed Data (Only if database is empty or explicitly needed)
echo "Seeding data..."
php artisan db:seed --force

# Start Apache
echo "Starting Apache..."
apache2-foreground
