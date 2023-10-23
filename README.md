# Instalación

Para descargar, ejecuta:

```sh
git clone https://github.com/davidrqch8800/api.git  
```
Una vez que esté instalado, debes hacer una copia de `.env`.

```sh
cp .env.example .env
```
Ahora instalar composer:
```sh
composer install
```

Generar la Key:

```sh
php artisan key:generate
```

## Configuración

Ahora debes configurar algunos datos para tu aplicación, como la el nombre de la BD. Dirígete al archivo `.env`. Aqui modificar el nombre por `apiLaravel` como se muestra acontinuación:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=apiLaravel
DB_USERNAME=root
DB_PASSWORD=
```
ahora hacer la migracion:
```sh
php artisan migrate
```
A continuación se mostrara el siguiente mensaje `Would you like to create it? (yes/no) [no]`, escribir  `yes` para crear el DB.

y por ultimo 
```sh
php artisan serve
```
