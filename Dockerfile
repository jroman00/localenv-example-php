FROM php:7.4.33-cli-buster

# Set up environment variables
ENV APP_NAME localenv-example-php
ENV APP_VERSION 0.1.0

# Install services
RUN apt-get update \
  && apt-get install -y $PHPIZE_DEPS \
  && apt-get install -y --no-install-recommends git libpq-dev unzip zip

# Install Xdebug
RUN pecl install xdebug-2.9.3

# Install database dpendencies
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_mysql pgsql pdo_pgsql

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
