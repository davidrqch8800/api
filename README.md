# Instalación

Para descargar, ejecuta:

```sh
git clone https://github.com/davidrqch8800/api.git  
```
Una vez que esté instalado, debes hacer una copia de `.env`.

```sh
cp .env.example .env
```

Generar la Key:

```sh
php artisan key:generate
```

Ahora instalar composer:
```sh
composer install
```
y hacer la migracion:
```sh
php artisan migrate
```
y por ultimo 
```sh
php artisan serve
```