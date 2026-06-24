#!/bin/sh

# Mengubah port listen Nginx sesuai dengan port yang diberikan oleh Render dinamis
if [ ! -z "$PORT" ]; then
    sed -i "s/listen 80 default_server;/listen ${PORT} default_server;/g" /etc/nginx/nginx.conf
    sed -i "s/listen \[::\]:80 default_server;/listen \[::\]:${PORT} default_server;/g" /etc/nginx/nginx.conf
fi

# Jalankan optimasi internal Laravel di production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi database otomatis (opsional)
# php artisan migrate --force

# Memulai Supervisor untuk menjalankan Nginx & PHP-FPM
exec /usr/bin/supervisord -c /etc/supervisord.conf