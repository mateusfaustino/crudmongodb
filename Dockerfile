FROM php:8.3-apache

# Install MongoDB extension
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libonig-dev \
        libzip-dev \
        unzip && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy application
COPY . /var/www/html

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
