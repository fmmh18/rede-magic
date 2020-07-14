# rede-magic
- Utilizado o php laravel na versão 5.7 com o PHP 7.3 a base de dados o MariaDB.

A proposta do projeto é um crud básico em API-rest utilizando o framework laravel.
Tive um duvida a respeito de atores e diretor ser uma tabela diferenciada que o filme, 
decidi simplificar o projeto deixando os campos atores e diretor em formato string para que possa ser prenchido indepentede de ID's.
Criei uma validação de campos obrigatórios e tipo no caso de Ano e Classificação do Filme como numérico podendo ser um integer.

Para se start o projeto é preciso configurar o .env com a base de dados de mysql obedecendo alguns parametros e se atentando ao campo usuario e senha.
no terminal acessar a pasta do projeto e utilizar o comando "ph artisan migrate" para se criar as tabelas necessárias. e para roda-lo localmente utilizar-se
o "php artisan serve" para realizar o teste dos metodos implementados.
Ira em anexo os collections do postman para que se faça mais agil.
