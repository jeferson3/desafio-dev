## Upload arquivo com persistência em banco com api de listagem de dados

## Requisitos
- PHP 8
- Composer
- Mysql

## Instalação
```sh
#-- Clonar repositório --#
https://github.com/jeferson3/desafio-dev.git

#-- Instalar depências --# 
composer install

#-- Criar .env a partir do env.example e alterar as credenciais do banco de dados --# 
cp .env.example .env

#-- Migrations - banco de dados --# 
php artisan migrate

#-- Criar key app --# 
php artisan key:generate

#-- Gerar documentação --# 
php artisan l5-swagger:generate

#-- Rodar os testes automatizados --# 
php artisan test

#-- Iniciar servidor --# 
php artisan serve

```

