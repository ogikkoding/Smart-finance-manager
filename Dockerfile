# Gunakan image resmi PHP 8.2 dengan Apache web server
FROM php:8.2-apache

# Aktifkan mod_rewrite (sangat berguna kalau kamu pakai routing/htaccess)
RUN a2enmod rewrite

# Salin semua file project kamu ke folder web server Apache
COPY . /var/www/html/

# Buka port 80 untuk akses web
EXPOSE 80