## Pistalibre

Plataforma web de convocatorias artísticas para conectar artistas e instituciones culturales.

## Requisitos previos

PHP 8.2 o superior
Composer
PostgreSQL 14 o superior
Node.js 18 o superior
N8N — npm install -g n8n

## Instalación

1. Descomprimir el proyecto y acceder a la carpeta
   cd pistalibre
2. Instalar dependencias
   composer install
3. Configurar el entorno
   cp .env.example .env
   php artisan key:generate
   Editar .env con los datos de PostgreSQL:
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=pistalibre
   DB_USERNAME=postgres
   DB_PASSWORD=root
4. Crear la base de datos en PostgreSQL
   CREATE DATABASE pistalibre;
5. Ejecutar migraciones y seeders
   php artisan migrate
   php artisan db:seed
6. Arrancar el servidor
   php artisan serve
   La API queda disponible en http://127.0.0.1:8000/api.

## Usuarios de prueba

- [Artista] email: ane@pistalibre.com / contraseña: password123
- [Institución] email: trama@pistalibre.com / contraseña: password123
- [Artista] email: admin@pistalibre.com / contraseña: password123

## Sistema de importación automática (N8N)

1. Arrancar N8N
   n8n start
2. Importar el workflow
   Acceder a http://localhost:5678, crear una cuenta, ir a Workflows → Import y seleccionar el archivo n8n/n8n-pistalibre.json incluido en el proyecto.
   Dentro del workflow hay que actualizar dos valores:

Nodo 3 (Claude): sustituir x-api-key por una API key válida de Anthropic (https://console.anthropic.com)
Nodo 4 (Code): sustituir el token por el Bearer token del usuario admin, que se obtiene haciendo login en /api/login

3. Publicar el workflow
   Pulsar Publish en N8N para activarlo.
4. Importar una convocatoria
   Enviar una petición POST al webhook con la URL de la convocatoria:
   POST http://localhost:5678/webhook/importar-convocatoria
   Content-Type: application/json

{
"url": "https://url-de-la-convocatoria.com"
}

La convocatoria se guarda automáticamente con estado pendiente y el administrador la aprueba desde el panel de administración.
