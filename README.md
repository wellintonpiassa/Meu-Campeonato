# Meu campeonato
### Detalhes
Para o desenvolvimento do projeto foram utilizadas as seguintes ferramentas:\

**Back-end:** Laravel\
**Front-end:** Angular\
**Banco de dados:** MySQL

### Instruções para executar o projeto:
Todo o projeto está dockerizado, portanto, necessita que tenha instalado Docker em sua máquina (saiba mais em https://www.docker.com).
Para inicializar o projeto basta estar na raiz do projeto e executar em um terminal os comandos abaixo:

``docker compose build``

``docker compose up``

Após todo processo do Docker, o projeto pode ser acessado pela URL **https://localhost:4200**.\
O banco de dados está disponível para acesso pela URL **https://localhost:8090** e as credenciais para se conectar são:\
**username**: root\
**password**: password

Neste projeto foi utilizado o conceito de ***migrate*** do Laravel, portanto, basta executar o comando abaixo no terminal para que as tabelas do banco sejam criadas automaticamente.

``docker exec -it meu-campeonato-backend php artisan migrate``
