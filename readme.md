l# Thanka Auction

## Installation Guide

```bash
# Installing dependencies
# Run at the time of installation
composer install

# Refreshing composer
composer dump-autoload

# Linking Storage
php artisan storage:link

# Clearing view (necessary on updating version)
php artisan view:clear

# Serving project
php artisan serve

# Serving websocket
php artisan websockets:serve

# Installing javascript dependencies
yarn

# Watching file change
yarn watch

# Docker for Database (Optional)
# Running db container in detached mode
docker-compose up -d
```