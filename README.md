## Setup BDD

1. Montar base de datos MySQL local en puerto 3306
2. Descargar archivo pruebatec.sql incluido en este repositorio
3. Crear base de datos ```pruebatec``` en panel de administracion de MySQL
4. Importar archivo pruebatec.sql en la BDD pruebatec.

## Setup Backend

Antes de seguir las instrucciones, se debe verificar si el equipo en donde se alojará el backend tiene instalado composer.

1. Ejecutar en consola:
```bash
git clone https://github.com/fquezadag1/PruebaTecHoldco-backend.git
```
2. Abrir Visual Studio y seleccionar carpeta generada.
3. Crear archivo .env en la carpeta del proyecto con lo siguiente:
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:PX7mcLjDZad9vrvPe1d8ny7JQgDxZRg3HbrELMpVSLo=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pruebatec
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

```
4. Abrir terminal en carpeta del proyecto para instalar dependencias 
```bash
composer install
```
5. Levantar backend con comando: 
```bash
php artisan serve 
```
