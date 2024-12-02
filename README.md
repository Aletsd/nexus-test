# Nexus Backend Coding Exercise

Este proyecto implementa un backend en Laravel 11 para gestionar marcas y modelos de vehículos. Proporciona endpoints RESTful para listar, crear, actualizar y filtrar marcas y modelos. Incluye un archivo SQL para la base de datos inicial y una colección de Postman para probar los endpoints.

---

## Requerimientos

### Software necesario
- **PHP** >= 8.1
- **Composer** >= 2.5
- **MySQL** >= 5.7
- **Laravel** >= 10
- **Postman** 

### Paquetes Laravel utilizados
- `laravel/laravel`: Framework base.
- `fakerphp/faker`: Generación de datos de prueba para el seeder.

---

## Instalación

Sigue estos pasos para configurar el proyecto:

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/Aletsd/nexus-test.git
   cd nexus-test
2. **Corre los siguientes comandos:**
   composer i
   php artisan migrate
   php artisan db:seed --class=BrandSeeder (opcional si quieres poblar la base de datos automaticamente)

3. **Puedes configurar a una base de datos modificando el .env dentro del directorio:**

- **DB_CONNECTION=mysql
- **DB_HOST=127.0.0.1
- **DB_PORT=3306
- **DB_DATABASE=nexus_test
- **DB_USERNAME=tu_usuario
- **DB_PASSWORD=tu_contraseña

### Rutas y funcionalidades

| Método | Ruta                       | Descripción                                                                 |
|--------|----------------------------|-----------------------------------------------------------------------------|
| GET    | `/brands`                  | Lista todas las marcas con su precio promedio.                             |
| POST   | `/brands`                  | Crea una nueva marca.                                                      |
| GET    | `/brands/{id}/models`      | Lista todos los modelos de una marca específica.                           |
| POST   | `/brands/{id}/models`      | Crea un nuevo modelo asociado a una marca.                                 |
| PUT    | `/models/{id}`             | Actualiza el precio promedio de un modelo existente.                       |
| GET    | `/models?greater=&lower=`  | Lista todos los modelos filtrados por rango de precios promedio.           |

### Si lo prefieres puedes utilizar el archivo postman y apuntar directamente al dominio
- **nexus-test.alexis-velasco.website	
