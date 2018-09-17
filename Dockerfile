FROM php:7.2.6-alpine3.7

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www

# Install dependencies
RUN composer install

EXPOSE 8080

# Start the php server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
