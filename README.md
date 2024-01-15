# Meu campeonato
### Detalhes
Para o desenvolvimento do projeto foram utilizadas as seguintes ferramentas:\

**Back-end:** Laravel\
**Front-end:** Angular\
**Banco de dados:** MySQL

### Instruções para executar o projeto:
Todo o projeto está dockerizado, portanto, necessita que tenha instalado Docker em sua máquina (saiba mais em https://www.docker.com).

Para inicializar basta estar na raiz do projeto e executar em um terminal os comandos abaixo:

``docker compose build``

``docker compose up``

Posteriormente, deve ser criar as tabelas do banco de dados, e como neste projeto foi utilizado o conceito de ***migrate*** do Laravel, basta executar o comando abaixo no terminal para que as tabelas do banco sejam criadas automaticamente.

``docker exec -it meu-campeonato-backend php artisan migrate``

O banco de dados está disponível para acesso pela URL **http://localhost:8090** e as credenciais para se conectar são:\
**username**: root\
**password**: password

Após todo processo do Docker, o front-end do projeto pode ser acessado pela URL **http://localhost:4200**, e o backend está escutando na porta 3000.

Além disso, foi realizada a implementação de ***seeder*** para alimentar o banco de times de futebol automaticamente. Para realizar esse processo basta executar o comando
``docker exec -it meu-campeonato-backend php artisan db:seed``
