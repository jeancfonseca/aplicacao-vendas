# Aplicacao Vendas
Aplicação para gerenciamento de vendas e comissões.

- Clonar projeto
- Acessar a pasta do projeto pelo terminal
- Rodar o composer (composer install)
- Criar banco 'vendas'
- Rodar migrations (php bin/console doctrine:migrations:migrate)
- Subir servidr PHP (php -S localhost:8000 -t public/)
- Acessar aplicação no navegador (localhost:8000)

Obs: Foi criado um comando para executar o envio de email diário, 
para o email cadastrado na página inicial. É possível executar esse comando no terminal 
(php bin/console email:enviar-relatorio-vendas-diaria), para a execução do comando ser 
automática eu criaria um script que chamaria esse comando e executaria diariamente
através da Crontab do Linux.