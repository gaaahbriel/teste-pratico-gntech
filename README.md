# Guia de Instalação e Execução — Clima API

##Sobre o projeto

###Este projeto consiste em uma API RESTful desenvolvida com Laravel que:

Consome dados da API pública da OpenWeather
Armazena os dados climáticos em banco MySQL
Disponibiliza endpoints RESTful
Possui documentação Swagger/OpenAPI
Está totalmente dockerizada com Docker Compose
Tecnologias utilizadas
PHP 8.2
Laravel
MySQL 8
Docker
Docker Compose
Nginx
Swagger/OpenAPI
OpenWeather API
Pré-requisitos

## Antes de iniciar, instale:

###1. Docker Desktop

 Docker Desktop Download

### 2. Git

Git Download

Clonando o projeto
git clone https://github.com/gaaahbriel/teste-pratico-gntech

Entrar na pasta do projeto
cd teste-pratico-gntech

Configuração do ambiente
1. Copiar arquivo .env

### Windows (PowerShell)
copy .env.example .env

### Linux/Mac
cp .env.example .env


## Configurar chave da API OpenWeather

Abra o arquivo:

.env

Adicione sua chave:

OPENWEATHER_API_KEY=SUA_CHAVE_AQUI

## Como obter a chave da API

### Criar conta na OpenWeather:

OpenWeather Sign Up

Gerar API Key
Inserir no .env

## Subindo o ambiente Docker

### Executar build dos containers
docker compose up -d --build

### Verificar containers
docker ps

### Os containers esperados:

laravel_app
laravel_nginx
laravel_mysql

### Acessar container Laravel
docker exec -it laravel_app bash

## Instalar dependências

### Dentro do container:

composer install

### Gerar APP_KEY
php artisan key:generate

### Rodar migrations
php artisan migrate

### Gerar documentação Swagger
php artisan l5-swagger:generate

## URLs do projeto
### API
http://localhost:8000

### Swagger/OpenAPI
http://localhost:8000/api/documentation

## Exemplos de endpoints

### Buscar todos os climas
GET /api/climas

### Exemplo:
http://localhost:8000/api/climas

### Buscar clima por ID
GET /api/climas/{id}

### Exemplo:
http://localhost:8000/api/climas/1

## Banco de dados
### Credenciais MySQL
Campo	Valor
Host	localhost
Porta	3307
Database	clima
Usuário	laravel
Senha	root


## Estrutura Docker

### O projeto utiliza:

## Serviço	Função
app	Laravel/PHP
nginx	Servidor web
mysql	Banco de dados


## Comandos úteis

### Derrubar containers
docker compose down

### Derrubar containers e volumes
docker compose down -v

### Rebuild completo
docker compose up -d --build

### Logs dos containers
docker compose logs -f

### Entrar no MySQL
docker exec -it laravel_mysql mysql -u laravel -p
Senha:
root

## Estrutura do projeto
app/
docker/
routes/
database/
config/
docker-compose.yml
Documentação Swagger

## A documentação da API foi implementada utilizando:
L5 Swagger GitHub

## Observações importantes

### Porta MySQL
O projeto utiliza:
3306

### Docker Desktop
Certifique-se de que o Docker Desktop esteja iniciado antes de executar:

docker compose up

### Possíveis problemas
Docker Engine não iniciado
Abra o Docker Desktop e aguarde:
Engine running

## Limpar cache Laravel

### Dentro do container:
php artisan optimize:clear

### Regenerar Swagger
php artisan l5-swagger:generate
