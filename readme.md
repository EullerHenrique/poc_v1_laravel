# Poc Laravel e Php Moderno

# Tecnologias Utilizadas

- Laravel 11
- Php 8.3

# Inicialização

1. docker-compose up -d
1.1. docker exec -it composer-2 bash
1.2. composer config -g repo.packagist composer https://packagist.org
1.3. composer config -g github-protocols https ssh
1.4. composer create-project --prefer-dist laravel/laravel:11.0 src
2.1 docker exec -it php-8.3 bash 
2.2 php artisan serve --host 0.0.0.0

## Execução

1. docker-compose up -d
1.2. composer config -g repo.packagist composer https://packagist.org
1.3. composer config -g github-protocols https ssh
2.1 docker exec -it php-8.3 bash 
2.2 php artisan serve --host 0.0.0.0

