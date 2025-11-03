# Proyecto-La Cuponera SV

Proyecto de la asignatura LIS941

# Instalación 🛠️

Primero deberás clonar el proyecto en tu maquina local, puedes hacerlo con GitHub Desktop o desde consola ( para eso deberás de tener instalado Git [Click para descargar Git](https://git-scm.com/downloads))
Para Ejecutar el proyecto deberás de tener instalado xampp para correr los servicios

En esta guia se clonará por medio de consola

1.  Abrir una terminal e ingresar a la ruta donde quieres clonar el repositorio (Ejemplo: **C:\Users\Usuario\Documentos>** ruta para la carpeta documentos ( si tienes problemas para usar la consola, puedes ver el siguiente video que te explica como acceder a una carpeta desde cmd [Como acceder a carpetas desde cmd](https://www.youtube.com/watch?v=HuTiugouE2o&ab_channel=computadorastiolne)

2.  Una vez dentro de la carpeta, ejecuta el siguiente comando en tu terminal para clonar el repositorio

> `git clone https://github.com/ManuelDuran95/lacuponerasv.git` \
> `git checkout fase-1`

3. Luego abre Visual Studio Code y abre el la carpeta clonada (lacuponerasv)

# Configuraciones iniciales ⚙

1.  Inicie los servicios de xampp

2.  Deberá de crear una base datos la cuál llamaremos **cuponera_db**

3.  Una vez creada la base de datos, abriremos una terminal en la ruta del proyecto, **C:\Users\Usuario\Documentos\lacuponerasv>** ( nuestra ruta de ejemplo )

4. Renombar el archivo .env.example a .env

5.  Pasos levantar la aplicacion en local:
    > `composer install`
    > `npm install`
    > `npm run build`
    > `php artisan key:generate`

6.  Para correr las migraciones y seeders ejecute el siguiente comando
    > `php artisan migrate --seed`

# Ejecutar Proyecto 🚀

Una vez hechas las configuraciones iniciales ejecutaremos el proyecto

1.  Recordar tener iniciados los servicios de xampp

2.  Abra una terminal en la ruta raiz del proyecto, **C:\Users\Usuario\Documentos\lacuponerasv>** ( nuestra ruta de ejemplo )

3.  ejecute el siguiente comando para correr el servidor

> `php artisan serve --no-reload`

4. Se mostrara la página web, para abrirla ubicarse encima de la ruta http://127.0.0.1:8000 y presionar ctrl + click
