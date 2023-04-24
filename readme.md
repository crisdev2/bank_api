# 1. Instrucciones de uso

## 1.1. Requerimientos
- PHP 8.2
- Symfony CLI
- Composer 2.x

## 1.2. Instalación:
Instale las dependencias con:
``composer install``

Configure la base de datos en el archivo .env
``DATABASE_URL="mysql://root:mysql@127.0.0.1:3306/app_bank?serverVersion=8&charset=utf8mb4"``

Cree la base de datos con el comando:
``php bin/console doctrine:database:create``

De forma opcional puede importar la base de datos **base_datos.sql**

Inicie el servidor web con el mando:
``symfony server:start``

## 1.3. Uso:
Siga las instrucciones para probar uno de los casos de uso del API:

Importe la colección de Postman **Bank API.postman_collection.json**

Ejecute el endpoint **auth/login**

Cree un cliente con el endpoint **customer/create**

Asocie una cuenta de ahorros al cliente con el endpoint **accounts/create**

Realice una transacción con el endpoint **transactions/create**

Apruebe la transacción con el endpoint **transactions/approve**

Nota: Al probar la transacción recuerde cambiar el ID en la URL por el ID de su transacción.
