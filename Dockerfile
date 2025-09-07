FROM php:8.2-fpm as build

RUN apt-get update && apt-get install -y \
git \
unzip \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libmagickwand-dev \
&& rm -rf /var/lib/apt/lists/*


# Instalar extensiones PHP requeridas
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd bcmath


# Instalar imagick en la versión requerida (3.8.0)
RUN pecl install imagick-3.8.0 \
&& docker-php-ext-enable imagick

# Instalar extensiones para Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer directamente
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Puerto PHP-FPM
EXPOSE 9000

FROM build as final

# Comando final
CMD ["php-fpm"]
