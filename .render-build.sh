#!/bin/bash

# Installer les dépendances
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Exécuter les migrations
php artisan migrate --force
