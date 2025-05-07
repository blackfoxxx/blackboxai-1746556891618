#!/bin/bash

# Script to build and run SecureBrand Laravel project with Docker

echo "Building and starting Docker containers..."
docker compose up --build -d

echo "Waiting for containers to initialize..."
sleep 15

echo "Running database migrations..."
docker exec -it securebrand-app php artisan migrate --force

echo "Seeding test data..."
docker exec -it securebrand-app php artisan setup:test-data

echo "Generating application key..."
docker exec -it securebrand-app php artisan key:generate

echo "Setting permissions..."
docker exec -it securebrand-app chown -R www-data:www-data storage bootstrap/cache

echo "Installation complete. The app should be accessible at http://localhost:8998"
