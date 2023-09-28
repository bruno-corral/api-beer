# Sobre a API

- Utilização de PHP 8 e Laravel 10 para criação e autenticação da API de produtos e cervejas.
- EloquentORM para fazer querys que irão trazer os dados do banco de dados.
- Banco de dados MySQL. O banco de dados possui uma tabela de usuários, produtos e cervejas.
- Utilizado migrations para a criação das tabelas

________________________

## Como executar localmente a api

1. Crie o banco de dados `api_beer` no MySQL;

2. Execute no terminal na raiz do projeto o comando `php artisan migrate` para criar as tabelas no banco de dados;

3. Execute no terminal na raiz do projeto o comando `php atisan serve` para iniciar o servidor do Laravel;

4. Para acessar use a url: `http://127.0.0.1:8000`