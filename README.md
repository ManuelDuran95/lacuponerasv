
# La Cuponera SV

La empresa “La Cuponera SV” es una organización dedicada a la venta de cupones de descuento
por internet. 

Pasos levantar la aplicacion en local

1- clonar el repo 

2- entrar a la carpeta y abrir el CMD  y correr el comando:

 composer install

 npm install

3- renombar el archivo .env.example a .env
4- crear la base de datos 

CREATE DATABASE cuponera_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

5- Ejecutar los comandos \

php artisan key:generate \
php artisan migrate --seed \
npm run build \
php artisan serve      

6- abrir http://127.0.0.1:8000