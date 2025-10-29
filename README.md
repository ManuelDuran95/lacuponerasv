1. Clonar el repositorio
git clone <repo>

entrar a la carpeta y abrir el CMD  y correr el comando:
composer install
npm install

renombar el archivo .env.example a .env

crear la base de datos 

CREATE DATABASE cuponera_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Ejecutar los comandos 
php artisan key:generate
php artisan migrate --seed
php artisan serve        # terminal 1
npm run dev              # terminal 2

# abrir http://127.0.0.1:8000