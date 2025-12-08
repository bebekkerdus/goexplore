FROM php:8.2-apache

# Install ekstensi PHP untuk MySQL/MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# (Opsional) Mengaktifkan mod_rewrite kalau nanti butuh
RUN a2enmod rewrite

# DocumentRoot bawaan sudah /var/www/html
WORKDIR /var/www/html
