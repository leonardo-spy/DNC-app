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
Para conseguir utilizar o WEBSITE como Administrador, voce pode utilizar o login abaixo que foi gerado junto com a população do banco de dados (Login para demonstração somente):
- email: teste@teste.com
- password: senha

## Endpoints
O Endpoints é acessado através da pagina pós login, mas que são formados de rotas públicas e rotas protegidas, as rotas públicas você consegue acessar sem a autentificação do Login, as rotas protegidas você precisa estar logado.
<br>
- Rotas públicas:

<b>Para realizar o Check-in</b><br>
<b>GET</b> /checkin
![image](https://user-images.githubusercontent.com/19514153/163470584-3eabb067-eb3e-49cd-8855-f82f346df80f.png)
<br>

<b>Para se logar</b><br>
<b>GET</b> /login
![image](https://user-images.githubusercontent.com/19514153/163470702-ee5aa98f-1843-46f4-afb6-12f014f4ebd8.png)
<br>

- Rotas protegida (precisa estar <b>LOGADO</b>):

<b>Para se deslogar</b><br>
<b>GET</b> /logout<br>
![image](https://user-images.githubusercontent.com/19514153/163470873-95887d10-7ab4-42d3-8f17-161578c178d0.png)
<br>

<b>Para visualizar todos os check-in's</b><br>
<b>GET</b> /manage/main<br>
![image](https://user-images.githubusercontent.com/19514153/163471115-72e73b83-9d7b-46fb-a2f2-40b385af7b93.png)
<br>

<b>Para inserir check-in</b><br>
<b>GET</b> /manage/inserircheckin<br>
![image](https://user-images.githubusercontent.com/19514153/163471192-0e441587-11ea-4cbe-9ac4-f740d480d1ab.png)
<br>

<b>Para editar check-in específico</b><br>
<b>GET</b> /checkin/edit/{id}<br>
![image](https://user-images.githubusercontent.com/19514153/163471270-360c5202-fd1c-4206-aaef-eb8fac41f8f1.png)
<br>

<b>Para deletar check-in específico</b><br>
<b>GET</b> /checkin/delete/{id}<br>
![image](https://user-images.githubusercontent.com/19514153/163471342-43f49d97-f07b-4e1e-8c89-4af146783f31.png)
<br>

<b>Para cadastrar novo funcionário (Funcionário não pertence aos usuÁrios administradores)</b><br>
<b>GET</b> /manage/cadastrarfuncionario<br>
![image](https://user-images.githubusercontent.com/19514153/163471382-181b2b4a-2d62-48b0-a79b-d4dbe2b8f065.png)
<br>

## Nota
Dependendo do Timezone do seu banco de dados, o horário de atualização do check-in pode ficar com horas de diferença!
<br>
## Notas do Dev
Eu Leonardo queria agradecer a DNC por estar proporcionando está oportunidade e por contribuir com a minha própra evolução.
