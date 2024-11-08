# Usa la imagen base de PHP con Apache
FROM php:8.2-apache

# Instala la extensión pdo_mysql y las herramientas necesarias
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite