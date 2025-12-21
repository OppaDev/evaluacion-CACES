# 🐳 Guía de Despliegue con Docker - Sistema de Evaluación CACES

Esta guía proporciona instrucciones paso a paso para desplegar el Sistema de Evaluación CACES utilizando Docker.

---

## 📋 Tabla de Contenidos

1. [Requisitos Previos](#-requisitos-previos)
2. [Estructura de Archivos Docker](#-estructura-de-archivos-docker)
3. [Configuración Inicial](#-configuración-inicial)
4. [Despliegue Rápido (Recomendado)](#-despliegue-rápido-recomendado)
5. [Despliegue Manual Paso a Paso](#-despliegue-manual-paso-a-paso)
6. [Acceso a la Aplicación](#-acceso-a-la-aplicación)
7. [Comandos Útiles](#-comandos-útiles)
8. [Solución de Problemas](#-solución-de-problemas)
9. [Configuración de Producción](#-configuración-de-producción)

---

## 🔧 Requisitos Previos

### Windows
1. **Docker Desktop para Windows**
   - Descargar desde: https://www.docker.com/products/docker-desktop
   - Requisitos: Windows 10/11 Pro, Enterprise o Education (64-bit)
   - Habilitar WSL 2 (Windows Subsystem for Linux)

### Linux (Ubuntu/Debian)
```bash
# Instalar Docker
sudo apt-get update
sudo apt-get install docker.io docker-compose

# Agregar usuario al grupo docker
sudo usermod -aG docker $USER

# Reiniciar sesión o ejecutar
newgrp docker
```

### macOS
1. **Docker Desktop para Mac**
   - Descargar desde: https://www.docker.com/products/docker-desktop
   - Compatible con Intel y Apple Silicon (M1/M2)

### Verificar Instalación
```bash
# Verificar Docker
docker --version
# Salida esperada: Docker version 24.x.x

# Verificar Docker Compose
docker-compose --version
# Salida esperada: Docker Compose version v2.x.x
```

---

## 📁 Estructura de Archivos Docker

```
evaluacion-CACES/
├── Dockerfile                 # Imagen PHP/Laravel
├── docker-compose.yml         # Orquestación de servicios
├── .dockerignore             # Archivos excluidos del build
├── .env.docker               # Variables de entorno para Docker
├── deploy.bat                # Script de despliegue (Windows)
├── deploy.sh                 # Script de despliegue (Linux/Mac)
└── docker/
    ├── nginx/
    │   └── conf.d/
    │       └── app.conf      # Configuración de Nginx
    ├── php/
    │   └── local.ini         # Configuración de PHP
    ├── mysql/
    │   └── my.cnf            # Configuración de MySQL
    └── scripts/
        └── entrypoint.sh     # Script de inicialización
```

---

## ⚙️ Configuración Inicial

### Paso 1: Clonar o Descargar el Proyecto

```bash
# Si el proyecto está en Git
git clone <url-del-repositorio>
cd evaluacion-CACES
```

### Paso 2: Configurar Variables de Entorno

El archivo `.env.docker` contiene la configuración predeterminada. Si necesitas personalizarla:

```bash
# Copiar archivo de configuración
cp .env.docker .env

# Editar según necesidades (opcional)
# nano .env  (Linux/Mac)
# notepad .env  (Windows)
```

**Variables importantes en `.env`:**

| Variable | Valor por Defecto | Descripción |
|----------|-------------------|-------------|
| `APP_URL` | `http://localhost:8080` | URL de la aplicación |
| `DB_HOST` | `db` | Nombre del servicio MySQL en Docker |
| `DB_DATABASE` | `caces_db` | Nombre de la base de datos |
| `DB_USERNAME` | `caces_user` | Usuario de MySQL |
| `DB_PASSWORD` | `secret` | Contraseña de MySQL |

---

## 🚀 Despliegue Rápido (Recomendado)

### Windows

1. **Abrir PowerShell o CMD como Administrador**
2. **Navegar al directorio del proyecto**
   ```cmd
   cd C:\ruta\al\proyecto\evaluacion-CACES
   ```
3. **Ejecutar el script de despliegue**
   ```cmd
   deploy.bat
   ```

### Linux / macOS

1. **Abrir Terminal**
2. **Navegar al directorio del proyecto**
   ```bash
   cd /ruta/al/proyecto/evaluacion-CACES
   ```
3. **Dar permisos y ejecutar el script**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

El script automáticamente:
- ✅ Verifica que Docker esté instalado y corriendo
- ✅ Crea el archivo `.env` si no existe
- ✅ Construye las imágenes Docker
- ✅ Inicia todos los contenedores
- ✅ Instala las dependencias de Composer
- ✅ Instala las dependencias de NPM y compila los assets
- ✅ Ejecuta las migraciones de base de datos
- ✅ Ejecuta los seeders (datos iniciales)

---

## 📝 Despliegue Manual Paso a Paso

Si prefieres ejecutar los comandos manualmente:

### Paso 1: Preparar el Entorno

```bash
# Navegar al proyecto
cd evaluacion-CACES

# Copiar archivo de entorno
cp .env.docker .env
```

### Paso 2: Construir las Imágenes

```bash
# Construir sin caché (primera vez o cambios en Dockerfile)
docker-compose build --no-cache

# O construir normalmente
docker-compose build
```

**Tiempo estimado:** 5-10 minutos (dependiendo de la conexión a internet)

### Paso 3: Iniciar los Contenedores

```bash
# Iniciar en segundo plano
docker-compose up -d
```

### Paso 4: Verificar que los Contenedores Estén Corriendo

```bash
docker-compose ps
```

**Salida esperada:**
```
NAME              COMMAND                  SERVICE      STATUS       PORTS
caces_app         "php-fpm"               app          Up           9000/tcp
caces_db          "docker-entrypoint..."  db           Up           0.0.0.0:3307->3306/tcp
caces_phpmyadmin  "/docker-entrypoint..."  phpmyadmin  Up           0.0.0.0:8081->80/tcp
caces_webserver   "/docker-entrypoint..."  webserver   Up           0.0.0.0:8080->80/tcp
```

### Paso 5: Esperar a MySQL

```bash
# Esperar 30 segundos para que MySQL esté completamente listo
# Windows
timeout /t 30

# Linux/Mac
sleep 30
```

### Paso 6: Instalar Dependencias

```bash
# Instalar dependencias de PHP
docker-compose exec app composer install

# Instalar dependencias de Node y compilar assets
docker-compose exec app npm install
docker-compose exec app npm run build
```

### Paso 7: Configurar Laravel

```bash
# Generar clave de aplicación
docker-compose exec app php artisan key:generate --force

# Crear enlace simbólico de storage
docker-compose exec app php artisan storage:link

# Limpiar cachés
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Paso 8: Ejecutar Migraciones y Seeders

```bash
# Ejecutar migraciones
docker-compose exec app php artisan migrate --force

# Ejecutar seeders (datos iniciales: roles, criterios, indicadores, etc.)
docker-compose exec app php artisan db:seed --force
```

### Paso 9: Optimizar (Opcional para Producción)

```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## 🌐 Acceso a la Aplicación

Una vez completado el despliegue:

| Servicio | URL | Credenciales |
|----------|-----|--------------|
| **Aplicación Web** | http://localhost:8080 | Ver seeders de usuarios |
| **phpMyAdmin** | http://localhost:8081 | Server: `db`, User: `caces_user`, Pass: `secret` |
| **MySQL directo** | `localhost:3307` | User: `caces_user`, Pass: `secret` |

### Credenciales por Defecto del Sistema

Después de ejecutar los seeders, puedes acceder con:

| Usuario | Email | Contraseña | Rol |
|---------|-------|------------|-----|
| ERICK GERMAN RIASCOS MORENO | `egriascos@espe.edu.ec` | `12345678` | Admin |
| NARCISA DE JESUS BAQUERO FONSECA | `ndbaquero1@espe.edu.ec` | (ver UserSeeder) | Admin |
| LUIS ALEJANDRO LEVOYER ROMERO | `lalevoyer@espe.edu.ec` | (ver UserSeeder) | Admin |

> 💡 **Credencial de prueba recomendada:** `egriascos@espe.edu.ec` / `12345678`

---

## 🛠 Comandos Útiles

### Gestión de Contenedores

```bash
# Ver contenedores corriendo
docker-compose ps

# Ver logs de todos los servicios
docker-compose logs

# Ver logs de un servicio específico
docker-compose logs app
docker-compose logs db
docker-compose logs webserver

# Ver logs en tiempo real
docker-compose logs -f

# Detener todos los contenedores
docker-compose stop

# Iniciar contenedores detenidos
docker-compose start

# Reiniciar todos los contenedores
docker-compose restart

# Detener y eliminar contenedores
docker-compose down

# Detener, eliminar contenedores Y volúmenes (⚠️ elimina datos de BD)
docker-compose down -v
```

### Ejecutar Comandos en el Contenedor de la App

```bash
# Abrir terminal en el contenedor
docker-compose exec app bash

# Ejecutar comandos Artisan
docker-compose exec app php artisan <comando>

# Ejecutar Composer
docker-compose exec app composer <comando>

# Ejecutar NPM
docker-compose exec app npm <comando>
```

### Comandos Artisan Frecuentes

```bash
# Limpiar todas las cachés
docker-compose exec app php artisan optimize:clear

# Ver rutas registradas
docker-compose exec app php artisan route:list

# Rollback de migraciones
docker-compose exec app php artisan migrate:rollback

# Refrescar base de datos (⚠️ elimina todos los datos)
docker-compose exec app php artisan migrate:fresh --seed

# Crear nuevo usuario admin
docker-compose exec app php artisan tinker
# Dentro de tinker:
# User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => bcrypt('password')])->assignRole('Admin');
```

### Gestión de Base de Datos

```bash
# Acceder a MySQL directamente
docker-compose exec db mysql -u caces_user -psecret caces_db

# Exportar base de datos
docker-compose exec db mysqldump -u caces_user -psecret caces_db > backup.sql

# Importar base de datos
docker-compose exec -T db mysql -u caces_user -psecret caces_db < backup.sql
```

---

## ❗ Solución de Problemas

### Error: "Puerto 8080 ya está en uso"

```bash
# En Windows (PowerShell como Admin)
netstat -ano | findstr :8080
taskkill /PID <PID> /F

# En Linux/Mac
sudo lsof -i :8080
sudo kill -9 <PID>

# O cambiar el puerto en docker-compose.yml
# ports:
#   - "8090:80"  # Cambiar 8080 por 8090
```

### Error: "MySQL connection refused"

```bash
# Verificar que MySQL esté corriendo
docker-compose logs db

# Esperar más tiempo y reintentar
docker-compose restart db
sleep 60
docker-compose exec app php artisan migrate
```

### Error: "Permission denied" en storage

```bash
# Linux/Mac - Dar permisos al directorio storage
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache

# Dentro del contenedor
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Error: "Class not found" o Composer

```bash
# Regenerar autoload de Composer
docker-compose exec app composer dump-autoload

# Reinstalar dependencias
docker-compose exec app composer install
```

### Error: "Vite manifest not found"

```bash
# Recompilar assets
docker-compose exec app npm install
docker-compose exec app npm run build
```

### Los cambios no se reflejan

```bash
# Limpiar todas las cachés
docker-compose exec app php artisan optimize:clear

# Reconstruir contenedores
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Reiniciar desde cero

```bash
# ⚠️ CUIDADO: Esto elimina todos los datos
docker-compose down -v
docker system prune -a --volumes
docker-compose build --no-cache
docker-compose up -d

# Esperar y configurar
sleep 30
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate:fresh --seed
```

---

## 🔒 Configuración de Producción

Para un entorno de producción, realiza los siguientes cambios:

### 1. Modificar `.env`

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Usar contraseñas seguras
DB_PASSWORD=contraseña_muy_segura_123!
```

### 2. Configurar HTTPS

Agregar un servicio de proxy inverso con SSL (ejemplo con Traefik o Nginx Proxy):

```yaml
# En docker-compose.yml, agregar labels para Traefik
webserver:
  labels:
    - "traefik.enable=true"
    - "traefik.http.routers.caces.rule=Host(`tu-dominio.com`)"
    - "traefik.http.routers.caces.tls.certresolver=letsencrypt"
```

### 3. Optimizar PHP

```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
docker-compose exec app composer install --no-dev --optimize-autoloader
```

### 4. Desactivar phpMyAdmin en producción

```yaml
# Comentar o eliminar el servicio phpmyadmin en docker-compose.yml
# phpmyadmin:
#   ...
```

### 5. Configurar backups automáticos

```bash
# Crear script de backup (backup.sh)
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
docker-compose exec -T db mysqldump -u caces_user -psecret caces_db > backups/backup_$DATE.sql
```

---

## 📞 Soporte

Si encuentras problemas no cubiertos en esta guía:

1. Revisa los logs: `docker-compose logs -f`
2. Verifica el estado de los contenedores: `docker-compose ps`
3. Consulta la documentación de Laravel: https://laravel.com/docs
4. Consulta la documentación de Docker: https://docs.docker.com

---

## 📄 Resumen de Puertos

| Puerto Local | Servicio | Descripción |
|--------------|----------|-------------|
| 8080 | Nginx | Aplicación web |
| 8081 | phpMyAdmin | Administración de BD |
| 3307 | MySQL | Acceso directo a BD |

---

**¡Listo!** 🎉 Tu Sistema de Evaluación CACES debería estar funcionando correctamente en Docker.
