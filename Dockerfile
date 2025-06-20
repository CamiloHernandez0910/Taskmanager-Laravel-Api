FROM php:8.2-apache

# Instalar extensiones
RUN apt-get update && apt-get install -y \
    git zip unzip curl libonig-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libxml2-dev mariadb-client

RUN docker-php-ext-install pdo pdo_mysql zip mbstring gd

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Cambiar DocumentRoot de Apache a /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Agregar directiva para que .htaccess funcione en /public
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/apache2.conf

# Copiar proyecto
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
