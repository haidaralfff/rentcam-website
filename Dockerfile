# Gunakan image PHP 7.4 dengan Apache
FROM php:7.4-apache

# Install ekstensi yang dibutuhkan CodeIgniter 3
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk Apache (penting untuk removal index.php)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy file proyek ke dalam container
COPY . .

# Set permission untuk folder uploads dan logs (jika ada)
RUN chown -R www-data:www-data /var/www/html/assets/uploads \
    && chmod -R 755 /var/www/html/assets/uploads

# Expose port 80
EXPOSE 80
