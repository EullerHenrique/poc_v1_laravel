# Poc V1 Laravel

# Tecnologias Utilizadas

- Laravel 11
- Php 8.3
- MySql 9
- Docker
- Composer 2

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
18. docker exec -it php-8.3 bash
    1. php artisan make:provider SeriesRepositoryProvider
19. docker exec -it php-8.3 bash
    1. php artisan make:migration --table=episodes add_watched_episode
    2. php artisan migrate
20. docker exec -it php-8.3 bash
    1. php artisan make:middleware Autenticador
21. docker exec -it php-8.3 bash
    1. php artisan make:mail SeriesCreated
22. docker exec -it php-8.3 bash
    1. php artisan queue:table
    2. php artisan migrate
    3. php artisan tinker
    4. DB::select('select * from jobs;');
    5. php artisan queue:work
    6. php artisan tinker
    7. DB::select('select * from failed_jobs;');
    8. php artisan queue:retry "all"
    9. php artisan queue:work --tries=2 --delay=10
23. docker exec -it php-8.3 bash
    1. php artisan queue:listen --tries=2
    2. php artisan make:listener EmailUsersAboutSeriesCreated
    3. php artisan make:event SeriesCreated
    4. php artisan make:listener LogSeriesCreated -e SeriesCreated
24. docker exec -it php-8.3 bash
    1. php artisan make:migration --table=series add_cover_column
    2. php artisan migrate
    3. php artisan storage:link
25. docker exec -it php-8.3 bash
    1. php artisan test
    2. php artisan make:test SeriesRepositoryTest
26. docker exec -it php-8.3 bash
    1. php artisan route:list

## Execução

1. docker-compose up -d
    1. docker exec -it composer-2 bash
        1. cd src
        2. composer config -g repo.packagist composer https://packagist.org
        3. composer config -g github-protocols https ssh
        4. composer install
    2. npm install
        1. npm run build
    3. docker exec -it php-8.3 bash 
        1. php artisan migrate
        2. php artisan serve --host 0.0.0.0

## Endpoints

1. http://127.0.0.1:8000/api/series [POST]
REQUEST: 
{
    "name": "Lost",
    "seasonsQty": 8,
    "episodesPerSeason": 3
}
RESPONSE:
{
    "name": "Lost",
    "cover": null,
    "updated_at": "2024-10-31T02:56:26.000000Z",
    "created_at": "2024-10-31T02:56:26.000000Z",
    "id": 22,
    "seasons": [
        {
            "id": 194,
            "number": 1,
            "serie_id": 22,
            "created_at": null,
            "updated_at": null
        },
    ]
}
    
2. http://127.0.0.1:8000/api/series/{id} [GET]

RESPONSE:
    
