# Poc Laravel

# Tecnologias Utilizadas

- Laravel 11
- Php 8.3
- MySql 9
- Docker

# Inicialização

1. docker-compose up -d
2. docker exec -it composer-2 bash
    1. composer config -g repo.packagist composer https://packagist.org
    2. composer config -g github-protocols https ssh
    3. composer create-project --prefer-dist laravel/laravel:11.0 src
3. docker exec -it php-8.3 bash 
    1. php artisan serve --host 0.0.0.0
4. npm install
    1. npm run build 
5. docker exec -it php-8.3 bash 
    1. php artisan make:controller SeriesController
6. docker exec -it php-8.3 bash 
    1. php artisan make:migration create_series_table
    2. php artisan migrate
7. docker exec -it php-8.3 bash
    1. php artisan make:model Serie
8. docker exec -it php-8.3 bash
    1. php artisas make:request SeriesFormRequest 
9. docker exec -it php-8.3 bash
    1. php artisan lang:publish
10. docker exec -it composer-2 bash
    1. cd src
    2. composer require lucascudo/laravel-pt-br-localization --dev
11. docker exec -it php-8.3 bash 
    php artisan vendor:publish --tag=laravel-pt-br-localization
12. docker exec -it php-8.3 bash 
    1. php artisan make:model Season -m
13. docker exec -it php-8.3 bash 
    1. php artisan make:model Episode -m
14. docker exec -it php-8.3 bash
    1. php artisan migrate
15. docker exec -it php-8.3 bash
    1. php artisan migrate:fresh
16. docker exec -it php-8.3 bash
    1. php artisan make:controller SeasonsController
17. docker exec -it composer-2 bash
    1. cd src
    2. composer require barryvdh/laravel-debugbar --dev
    3. Caso queira publicar: php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"


## Execução

1. docker-compose up -d
    1. composer config -g repo.packagist composer https://packagist.org
    2. composer config -g github-protocols https ssh
    3. docker exec -it php-8.3 bash 
    4. php artisan serve --host 0.0.0.0

