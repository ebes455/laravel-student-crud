# Task 2/4 - Laravel 13 + PHP 8.4 (composer.json needs php ^8.3, 8.2 will FAIL)
FROM php:8.4-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip curl sqlite3 libsqlite3-dev libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_sqlite pdo_mysql mbstring bcmath gd zip exif pcntl \
    && a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN cp -n .env.example .env || true \
    && sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env \
    && sed -i '/DB_HOST=/d; /DB_PORT=/d; /DB_DATABASE=/d; /DB_USERNAME=/d; /DB_PASSWORD=/d' .env \
    && touch database/database.sqlite \
    && php artisan key:generate --force \
    && php artisan migrate:fresh --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80
CMD ["apache2-foreground"]
