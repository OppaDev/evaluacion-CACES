# =============================================================================
# Dockerfile - Sistema de Acreditación CACES
# PHP 8.2 FPM Alpine (Multi-stage optimizado)
# =============================================================================

# -----------------------------------------------------------------------------
# Etapa 1: Base con PHP y extensiones
# -----------------------------------------------------------------------------
FROM php:8.2-fpm-alpine AS base

WORKDIR /var/www/html

# Instalar dependencias y extensiones PHP
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    jpeg-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip \
    gd \
    xml \
    intl \
    opcache

# Configurar OPcache para producción
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Configurar PHP
RUN echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# -----------------------------------------------------------------------------
# Etapa 2: Builder (Composer + Node)
# -----------------------------------------------------------------------------
FROM base AS builder

# Instalar Node.js para compilar assets
RUN apk add --no-cache nodejs npm

# Instalar dependencias de Composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader --prefer-dist

# Instalar dependencias de Node y compilar assets
COPY package.json package-lock.json ./
RUN npm ci --silent
COPY . .
RUN npm run build

# -----------------------------------------------------------------------------
# Etapa 3: Producción (imagen final limpia)
# -----------------------------------------------------------------------------
FROM base AS production

# Copiar vendor desde builder
COPY --from=builder /var/www/html/vendor ./vendor

# Copiar assets compilados
COPY --from=builder /var/www/html/public/build ./public/build

# Copiar código fuente
COPY --from=builder /var/www/html .

# Establecer permisos
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Puerto PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
