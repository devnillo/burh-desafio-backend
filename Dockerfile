FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN if [ ! -d "vendor" ]; then composer install; fi

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
