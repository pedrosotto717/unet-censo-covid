# Unet Censo Covid

La Alcaldía de San Cristóbal dada la emergencia sanitaria en la que se encuentra actualmente por el
contagio de una importante porción de la población en la Ciudad y en todo el Estado Táchira se ha
visto en la necesidad de censar y monitorear a la población afectada que habita y reside en la ciudad.
Para esto la secretaría de salud en reuniones con el Departamento de Ing. En Informática de la UNET
decidieron crear una alianza para desarrollar un sistema en ambiente web para que los habitantes
afectados por algunas de las enfermedades (Covid - 19, Covid con variación o Viruela de mono) se
puedan registrar e indicar los síntomas, tratamientos recibidos, etc. Para que con esto la alcaldía
pueda llevar además del censo de los habitantes afectados un monitoreo de cada uno de ellos,
donde se les podrá brindar ayuda en caso de que no tengas los recursos de dirigirse a un centro de
salud.

## Pasos para la ejecucion del proyecto

1. Clonar el repositorio o descargar.
1. Abrir su gestor de base de datos.
1. crear una base de datos llamada por comodidad "unet-censo"
1. Entra al proyecto.
1. configurar el archivo .env (puede apoyarse de .env.example)
1. Una vez configurado el entorno, Ejecuta en consola el comando ```php artisan migrate```, esto correra las migraciones.
1. Seguidamente ejecuta ```php artisan db:wipe```
1. Para levantar el servidor en local ```php artisan serve```
1. Dirigete a tu navegador.
1. Ingresa a ```http://localhost:8000/```
1. Ve a Login y accede con el usuario administrador.
```
Usuario: marcel@gmail.com
Contraseña: 12345678
```

***

## Desarrollado por los estudiantes:
```
Pedro José Soto Ayala 
CI: 27.893.308
```
```
Gabriel Diaz Andrade
CI: 28.230.550
```
