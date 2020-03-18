FROM php:7.4.3-alpine3.11

# Set up environment variables
ENV APP_NAME localenv-example-php
ENV APP_VERSION 0.0.1

# Install services
RUN apk add --no-cache --update $PHPIZE_DEPS

# Install Xdebug
RUN pecl install xdebug-2.9.3

# Enable php extensions
RUN docker-php-ext-enable xdebug

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www

# Install dependencies
RUN composer install

# Expose application port
EXPOSE 8081

# Start the php server
CMD ["php", "-S", "0.0.0.0:8081", "-t", "public"]
