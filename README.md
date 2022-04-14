# DNC App - CRUD

## DNC Website

Website em Laravel 8 para realizar o CRUD de check-ins e cadastramento de novos funcionarios.

## O que o projeto contém
- Laravel 8
- CRUD
- Autenticação
- Seeder e uso de fakers

## Instalação
Para rodar o projeto faça essas configurações:
- Clone o projeto (utilizando comando git ou baixando em zip)
- Instale o composer
```
php composer install
php composer update
```
- Renomeie o .env.example para .env
- Configure o banco de dados como no exemplo abaixo
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dnc
DB_USERNAME=root
DB_PASSWORD=
```
- Rode a migrations para criar as tabelas do banco de dados
```
php artisan migrate
```
- Para popular com dados Fake utilize o comando abaixo
```
php artisan db:seed
```

## Endpoints
Para conseguir utilizar o WEBSITE como Administrador, voce pode utilizar o login abaixo gerado junto com o Seed
<br>
<b>Login:</b>
```
{
    "email": "teste@teste.com",
    "password": "senha",
}
```
Readme em construção! Volte mais tarde :)
Nota: Dependendo do Timezone do seu banco de dados, o horário de atualização do check-in pode ficar com horas de diferença!