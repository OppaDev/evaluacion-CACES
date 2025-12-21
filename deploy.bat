@echo off
REM ============================================
REM Script de despliegue para Windows
REM Sistema de Evaluación CACES
REM ============================================

echo ============================================
echo   Desplegando Sistema de Evaluacion CACES
echo ============================================

REM Verificar si Docker está instalado
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Docker no esta instalado. Por favor, instale Docker Desktop.
    pause
    exit /b 1
)

REM Verificar si Docker está corriendo
docker info >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Docker no esta corriendo. Por favor, inicie Docker Desktop.
    pause
    exit /b 1
)

echo [INFO] Docker esta funcionando correctamente.

REM Crear archivo .env si no existe
if not exist ".env" (
    echo [INFO] Creando archivo .env desde .env.docker...
    copy .env.docker .env
)

REM Detener contenedores anteriores si existen
echo [INFO] Deteniendo contenedores anteriores...
docker-compose down 2>nul

REM Construir e iniciar contenedores
echo [INFO] Construyendo imagenes Docker...
docker-compose build --no-cache

echo [INFO] Iniciando contenedores...
docker-compose up -d

REM Esperar a que los contenedores estén listos
echo [INFO] Esperando a que los servicios esten listos...
timeout /t 30 /nobreak >nul

REM Ejecutar comandos de Laravel dentro del contenedor
echo [INFO] Configurando Laravel...

docker-compose exec -T app composer install
docker-compose exec -T app npm install
docker-compose exec -T app npm run build
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan storage:link 2>nul
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan cache:clear
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force

echo ============================================
echo   Despliegue completado exitosamente!
echo ============================================
echo.
echo   Aplicacion: http://localhost:8080
echo   phpMyAdmin:  http://localhost:8081
echo.
echo   Usuario de base de datos: caces_user
echo   Contrasena de base de datos: secret
echo.
echo ============================================

pause
