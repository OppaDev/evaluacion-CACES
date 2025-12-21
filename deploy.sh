#!/bin/bash

# ============================================
# Script de despliegue para Linux/Mac
# Sistema de Evaluación CACES
# ============================================

set -e

echo "============================================"
echo "  Desplegando Sistema de Evaluación CACES"
echo "============================================"

# Verificar si Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "[ERROR] Docker no está instalado. Por favor, instale Docker."
    exit 1
fi

# Verificar si Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "[ERROR] Docker Compose no está instalado. Por favor, instale Docker Compose."
    exit 1
fi

# Verificar si Docker está corriendo
if ! docker info &> /dev/null; then
    echo "[ERROR] Docker no está corriendo. Por favor, inicie el servicio de Docker."
    exit 1
fi

echo "[INFO] Docker está funcionando correctamente."

# Crear archivo .env si no existe
if [ ! -f ".env" ]; then
    echo "[INFO] Creando archivo .env desde .env.docker..."
    cp .env.docker .env
fi

# Dar permisos de ejecución a scripts
chmod +x docker/scripts/*.sh 2>/dev/null || true

# Detener contenedores anteriores si existen
echo "[INFO] Deteniendo contenedores anteriores..."
docker-compose down 2>/dev/null || true

# Construir e iniciar contenedores
echo "[INFO] Construyendo imágenes Docker..."
docker-compose build --no-cache

echo "[INFO] Iniciando contenedores..."
docker-compose up -d

# Esperar a que los contenedores estén listos
echo "[INFO] Esperando a que los servicios estén listos..."
sleep 30

# Ejecutar comandos de Laravel dentro del contenedor
echo "[INFO] Configurando Laravel..."

docker-compose exec -T app composer install
docker-compose exec -T app npm install
docker-compose exec -T app npm run build
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan storage:link 2>/dev/null || true
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan cache:clear
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force

echo "============================================"
echo "  ¡Despliegue completado exitosamente!"
echo "============================================"
echo ""
echo "  Aplicación: http://localhost:8080"
echo "  phpMyAdmin:  http://localhost:8081"
echo ""
echo "  Usuario de base de datos: caces_user"
echo "  Contraseña de base de datos: secret"
echo ""
echo "============================================"
