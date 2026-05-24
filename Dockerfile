FROM php:7.4-apache

# Enable Apache rewrite module for CodeIgniter routing
RUN a2enmod rewrite

# Install PHP extensions yang diperlukan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configure Apache DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Create logs directory if it doesn't exist
RUN mkdir -p /var/www/html/application/logs && \
    chown -R www-data:www-data /var/www/html/application/logs

EXPOSE 80
