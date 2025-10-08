# Projeto Dianita Café (PIT II)
Este projeto foi desenvolvido para a disciplina **Projeto Integrador em TI II** e é a continuação do trabalho iniciado no **PIT I**, onde a proposta era criar um sistema funcional para uma cafeteria.
## 🎯 Objetivo
O objetivo é permitir que a cafeteria **Dianita Café** possa apresentar seu cardápio de produtos e receber pedidos online de forma simples e eficiente. O sistema simula uma cafeteria real, oferecendo opções de cafés, doces e salgados.
## ⚙️ Como o sistema funciona
O cliente acessa o site e visualiza o cardápio completo, escolhe produtos, define quantidades e adiciona ao carrinho. Após revisar o carrinho, informa seus dados e escolhe a forma de pagamento. O pedido é registrado no banco de dados, e o administrador pode acompanhar e gerenciar os pedidos.
## 🧠 Tecnologias utilizadas
**PHP 8** – linguagem principal do sistema.
**MySQL** – banco de dados relacional.
**HTML5, CSS3 e Bootstrap 5** – estrutura e design das páginas.
**JavaScript básico** – interação simples e dinâmica.
**Modelo MVC** – separação de camadas de lógica, dados e apresentação.
## 💻 Como testar localmente (XAMPP)
1. Instale o **XAMPP** no computador.
2. Copie a pasta do projeto para `C:\xampp\htdocs\cafeteria-pit\`.
3. Crie o banco de dados `cafeteria_pit` no **phpMyAdmin**.
4. Importe o arquivo `sql/schema_completo.sql` e depois `sql/seed_produtos.sql`.
5. Ajuste o arquivo `models/DB.php` com as credenciais locais:
```php
$host = 'localhost'; $dbname = 'cafeteria_pit'; $usuario = 'root'; $senha = '';
```
6. Inicie o Apache e o MySQL no XAMPP.
7. Acesse o sistema: `http://localhost/cafeteria-pit/`.
## 🌐 Sistema online (versão hospedada)
O projeto está hospedado gratuitamente no **InfinityFree**:
👉 [https://dianitacafe.rf.gd](https://dianitacafe.rf.gd)
Configurações de produção:
```php
$host = 'sql209.infinityfree.com'; $dbname = 'if0_39966532_cafeteria'; $usuario = 'if0_39966532'; $senha = '********';
```
## 🔑 Acesso administrativo
URL: `/admin/login.php`
Usuário: `admin`
Senha: `admin123`
> A área administrativa permite consultar pedidos e gerenciar produtos.
## 🧩 Estrutura de pastas
/ (raiz)
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
## 🗃️ Banco de dados
Tabelas: `clientes`, `produtos`, `pedidos`, `itens_pedido`, `pagamentos`.
Relações principais:
- Um cliente pode ter vários pedidos (1:N).
- Cada pedido possui vários itens (1:N).
- Cada item de pedido está ligado a um produto (N:1).
- Pagamentos se relacionam diretamente a um pedido (1:1).
## 📊 Diagramas do sistema
Na pasta `/diagrams/` estão os modelos:
- **Conceitual:** `Dianita_Cafe_Modelo_Conceitual.drawio`
- **Lógico:** `Dianita_Cafe_Modelo_Logico_Setas.drawio`
## 🧾 Observações finais
Projeto acadêmico, sem coleta de dados sensíveis. Desenvolvido gradualmente com testes locais no XAMPP e hospedagem gratuita no InfinityFree. Código simples, comentado e estruturado para aprendizado.
## 👨‍💻 Autoria
Trabalho acadêmico desenvolvido por **Ricardo Domingos**
Curso: Tecnologia em Análise e Desenvolvimento de Sistemas
Instituição: Cruzeiro do Sul Virtual – 2025
