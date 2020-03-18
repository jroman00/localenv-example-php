FROM php:7.3.1-cli-alpine3.8

# Set up environment variables
ENV APP_NAME localenv-example-php
ENV APP_VERSION 0.0.1

# Install services
RUN apk add --no-cache --update $PHPIZE_DEPS

# Install Xdebug
RUN pecl install xdebug-2.7.0RC1

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
