# Projeto Dianita Café (PIT II)
Este projeto foi desenvolvido para a disciplina Projeto Integrador em TI II e é a continuação do trabalho iniciado no PIT I, onde a proposta era criar um sistema funcional para uma cafeteria.
## Objetivo
Permitir que a cafeteria Dianita Café apresente seu cardápio de produtos e receba pedidos online de forma simples e eficiente. O sistema simula uma cafeteria real, oferecendo opções de cafés, doces e salgados.
## Como o sistema funciona
O cliente acessa o site, visualiza o cardápio, escolhe produtos, define quantidades e adiciona ao carrinho. Depois, informa seus dados e escolhe a forma de pagamento. O pedido é registrado no banco de dados, e o administrador pode acompanhar e gerenciar os pedidos.
## Tecnologias utilizadas
- PHP 8 (linguagem principal)
- MySQL (banco de dados relacional)
- HTML5, CSS3 e Bootstrap 5 (estrutura e design)
- JavaScript básico (interatividade)
- Estrutura MVC (organização do código)
## Como testar localmente (XAMPP)
1. Instalar o XAMPP no computador.
2. Copiar a pasta do projeto para C:\xampp\htdocs\cafeteria-pit\.
3. Criar o banco de dados cafeteria_pit no phpMyAdmin.
4. Importar sql/schema_completo.sql e depois sql/seed_produtos.sql.
5. Ajustar models/DB.php com as credenciais locais:
```php
$host = 'localhost'; $dbname = 'cafeteria_pit'; $usuario = 'root'; $senha = '';
```
6. Iniciar o Apache e o MySQL no XAMPP.
7. Acessar http://localhost/cafeteria-pit/.
## Sistema online (InfinityFree)
O sistema está hospedado gratuitamente em:
https://dianitacafe.rf.gd
Configurações de produção:
```php
$host = 'sql209.infinityfree.com';
$dbname = 'if0_39966532_cafeteria';
$usuario = 'if0_39966532';
$senha = '********';
```
## Acesso administrativo
- URL: /admin/login.php
- Usuário: admin
- Senha: admin123
Permite consultar pedidos e gerenciar produtos.
## Estrutura de pastas
index.php
carrinho.php
checkout.php
/controllers
/models
/views
/admin
/sql
/diagrams
/docs
## Banco de dados
Tabelas: clientes, produtos, pedidos, itens_pedido, pagamentos.
Relações principais:
- Um cliente pode ter vários pedidos (1:N)
- Cada pedido possui vários itens (1:N)
- Cada item está ligado a um produto (N:1)
- Cada pagamento está ligado a um pedido (1:1)
## Diagramas do sistema
- Conceitual: Dianita_Cafe_Modelo_Conceitual.drawio
- Lógico: Dianita_Cafe_Modelo_Logico_Setas.drawio
## Observações finais
Projeto acadêmico, desenvolvido de forma gradual, com testes no XAMPP e hospedagem gratuita no InfinityFree. O código é simples, organizado e voltado para aprendizado.
## Autoria
Trabalho desenvolvido por Ricardo Domingos

Curso: Sistemas de Informação

Instituição: Faculdade Cruzeiro do Sul – 2025
