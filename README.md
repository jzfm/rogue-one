##NEMURU CHALLANGE

##Ejecutar la aplicación:
- No modificar ficheros de config (no tocar .env)
- Ejecutar los siguientes comandos en la carpeta del proyecto:
    - 'docker run --rm -v $(pwd):/app composer install' o 'composer install'
    - 'docker-compose up -d'
    - 'docker-compose exec app php artisan migrate'

- En caso de que la dockerización de problemas, cualquier entorno LAMP/XAMP/WAMP (con mysql) podrá ejecutar la aplicación
sin problemas. Solo se deberá actualizar dependencias (composer install) y crear una base de datos llamada rogue, ejecutando la
migración (php artisan migrate), ya estaria funcional.

##Endpoints de la API:
    - Para calcular area: 
        - Acción: POST 
        - URL: http://localhost/api/v1/area
        - Body: 
            {
                "n": 15000,
                "uuid": "test"
            }
    - Para obtener area:
        - Acción: GET
        - URL: http://localhost/api/v1/area/{uuid}
        - Body: N/A

Consideraciones:
    - He implementado la aplicación siguiendo un diseño DDD e implementando arquitectura hexagonal, de manera
    que el dominio es agnostico a las integraciones de terceros, infraestructura o frameworks.
    - Las solicitudes siguen un patron de comandos (DTOs) según el patron de CQRS, sin embargo no he
    llegado a implementar la mensajeria/eventos ni la persistencia por transacciones.
    - No he implementado el calculo de area usando el metodo del trapecio, por lo que la aplicación genera decimales
    aleatorios