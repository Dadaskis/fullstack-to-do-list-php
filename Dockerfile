# Use an official PHP image with Apache
FROM php:8.2-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application files into the container
COPY . .

# Install any necessary PHP extensions (if needed)
RUN docker-php-ext-install pdo_mysql

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]