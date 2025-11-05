FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite - en caso de usarse
RUN a2enmod rewrite

# Copiar código al contenedor
COPY ./src /var/www/html/
