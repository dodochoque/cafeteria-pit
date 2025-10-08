# Dianita Café – Backup Completo (2025-10-08)

Este pacote contém o código-fonte, scripts SQL, diagramas e orientações para rodar o sistema **Dianita Café** em **XAMPP (local)** e **InfinityFree (online)**.

## Estrutura
```
/ (raiz)
  index.php
  carrinho.php
  checkout.php
  /controllers/PedidoController.php
  /models/DB.php, Produto.php
  /views/home.php
  /admin/login.php, pedidos.php, logout.php
  /sql/schema_completo.sql, seed_produtos.sql
  /diagrams/Dianita_Cafe_Modelo_Conceitual.drawio (editável)
  /docs/README.md
```

## 1) Rodando no XAMPP (local)
1. Crie o banco `cafeteria_pit` no phpMyAdmin.
2. **Importe** `sql/schema_completo.sql`.
3. **Importe** `sql/seed_produtos.sql` para popular o cardápio.
4. Edite `models/DB.php` (local):

```php
$host = 'localhost';
$dbname = 'cafeteria_pit';
$usuario = 'root';
$senha = '';
```
5. Copie tudo para `C:/xampp/htdocs/cafeteria-pit/`.
6. Acesse: `http://localhost/cafeteria-pit/index.php`.

## 2) Rodando no InfinityFree (online)
1. Crie o banco MySQL (ex.: `if0_XXXX_cafeteria`) e anote host/usuário/senha.
2. No **File Manager**, envie os arquivos para a pasta **htdocs** (mantenha a mesma estrutura).
3. Edite `models/DB.php` (produção):

```php
$host = 'sql209.infinityfree.com';
$dbname = 'if0_XXXX_cafeteria';
$usuario = 'if0_XXXX';
$senha = 'SUA_SENHA';
```
4. No phpMyAdmin da hospedagem, **importe** `sql/schema_completo.sql` e depois `sql/seed_produtos.sql`.
5. Acesse o site (ex.: `https://seusite.rf.gd/`).

## 3) Acesso à área administrativa
- Login: acesse `/admin/login.php`
- Senha padrão: **admin123** (altere em `admin/login.php`).

## 4) Observações importantes
- `itens_pedido`: usa `preco_unit` e `total_item` — o código já está ajustado.
- `pagamentos`: usa `status_pagamento` — ajustado em `checkout.php`.
- Se o carrinho não atualizar, verifique **cookies/sessão**.

## 5) Diagramas
- **Conceitual editável**: `diagrams/Dianita_Cafe_Modelo_Conceitual.drawio`
  - Abra em: https://app.diagrams.net → “Open from Device”

## 6) Links para o relatório
- GitHub: (seu repositório)
- Solução online: (InfinityFree)
- Vídeo narrado: (YouTube / Drive)
