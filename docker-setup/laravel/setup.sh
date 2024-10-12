#!/bin/ash

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if [ ! -f "database/database.sqlite" ]; then
    touch database/database.sqlite
fi

if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    composer install
fi

if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

php artisan optimize:clear

php artisan migrate:fresh --seed
