#!/bin/bash

# ============================================
# Script de inicialización para Docker
# Sistema de Evaluación CACES
# ============================================

set -e

echo "============================================"
echo "  Iniciando configuración de Laravel..."
echo "============================================"

# Esperar a que MySQL esté listo
echo "Esperando a que MySQL esté disponible..."
while ! nc -z db 3306; do
    sleep 1
done
echo "MySQL está listo!"

# Crear enlace simbólico de storage si no existe
if [ ! -L "public/storage" ]; then
    echo "Creando enlace simbólico de storage..."
    php artisan storage:link
fi

# Verificar si el archivo .env existe
if [ ! -f ".env" ]; then
    echo "Copiando archivo de entorno..."
    cp .env.docker .env
fi

# Generar clave de aplicación si no existe
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generando clave de aplicación..."
    php artisan key:generate --force
fi

# Limpiar cachés
echo "Limpiando cachés..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders (solo si la tabla users está vacía)
USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();" 2>/dev/null | tail -1)
if [ "$USER_COUNT" = "0" ] || [ -z "$USER_COUNT" ]; then
    echo "Ejecutando seeders..."
    php artisan db:seed --force
fi

# Optimizar para producción
echo "Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "============================================"
echo "  ¡Configuración completada con éxito!"
echo "============================================"

# Ejecutar PHP-FPM
exec php-fpm
