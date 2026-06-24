# === Stage 1: Build Frontend Assets ===
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# === Stage 2: Application Runtime ===
FROM php:8.2-fpm-alpine

# Install sistem dependensi dan ekstensi PHP yang dibutuhkan Laravel
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo_mysql bcmath

# Install Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Menyalin seluruh source code aplikasi
COPY . .

# Menyalin hasil build frontend dari Stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Install dependensi PHP (Production mode)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Mengatur permissions agar Laravel bisa menulis log dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Menyalin file konfigurasi Nginx & Supervisor
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf

# Ekspos port default (Render akan menimpa port ini secara otomatis menggunakan $PORT)
EXPOSE 80

# Menjalankan startup script saat container berjalan
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]