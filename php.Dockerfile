# Use a descriptive tag for the base image
FROM php:8.2-fpm-alpine AS base


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Install Symfony CLI (optional)
RUN curl -LsS https://github.com/symfony/cli/releases/latest/download/symfony_linux_amd64.gz | \
    gzip -d -c > /usr/local/bin/symfony && \
    chmod +x /usr/local/bin/symfony \

# Install PDO extension
RUN docker-php-ext-install pdo

WORKDIR /var/www/html
RUN apk add icu-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Install pdo_mysql extension
RUN docker-php-ext-install pdo_mysql