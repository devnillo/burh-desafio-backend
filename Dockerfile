FROM php:8.3-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    nano \
    libxml2-dev \
    && docker-php-ext-install pdo_pgsql mbstring zip pcntl dom

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
