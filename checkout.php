<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name("cafeteria_sessao");
    session_start();
}
require_once __DIR__ . '/models/Produto.php';
require_once __DIR__ . '/models/DB.php';

$db = DB::conexao();
$carrinho = $_SESSION['carrinho'] ?? [];
$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $pagamento = trim($_POST['pagamento'] ?? '');

    if (!empty($carrinho) && $nome && $email && $endereco && $pagamento) {
        try {
            $db->beginTransaction();

            // Cliente (reaproveita por email)
            $stmt = $db->prepare("SELECT id_cliente FROM clientes WHERE email = ?");
            $stmt->execute([$email]);
            $cliente = $stmt->fetch();

            if ($cliente) {
                $id_cliente = $cliente['id_cliente'];
            } else {
                $stmt = $db->prepare("INSERT INTO clientes (nome, email, endereco) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $endereco]);
                $id_cliente = $db->lastInsertId();
            }

            // Pedido
            $stmt = $db->prepare("INSERT INTO pedidos (id_cliente, data_pedido, status) VALUES (?, NOW(), 'Pendente')");
            $stmt->execute([$id_cliente]);
            $id_pedido = $db->lastInsertId();

            $total = 0;

            // Itens do pedido
            foreach ($carrinho as $id_produto => $qtd) {
                $produto = Produto::obterPorId($id_produto);
                if (!$produto) continue;
                $subtotal = $produto['preco'] * $qtd;
                $total += $subtotal;

                $stmt = $db->prepare("INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unit, total_item) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$id_pedido, $id_produto, $qtd, $produto['preco'], $subtotal]);
            }

            // Pagamento (status pendente)
            $stmt = $db->prepare("INSERT INTO pagamentos (id_pedido, metodo, valor, status_pagamento) VALUES (?, ?, ?, 'pendente')");
            $stmt->execute([$id_pedido, $pagamento, $total]);

            $db->commit();
            unset($_SESSION['carrinho']);
            $mensagem = "Pedido realizado com sucesso! Número do pedido: " . $id_pedido;
        } catch (Exception $e) {
            $db->rollBack();
            $mensagem = "Erro ao finalizar pedido: " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha todos os campos e adicione itens ao carrinho.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Dianita Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Checkout</h1>

  <?php if($mensagem): ?>
    <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
    <a href="/index.php" class="btn btn-primary">Voltar ao Cardápio</a>
  <?php elseif(empty($carrinho)): ?>
    <div class="alert alert-warning">Seu carrinho está vazio.</div>
    <a href="/index.php" class="btn btn-primary">Voltar ao Cardápio</a>
  <?php else: ?>
    <form method="post" class="mt-3">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" id="endereco" name="endereco" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="pagamento" class="form-label">Método de Pagamento</label>
        <select id="pagamento" name="pagamento" class="form-control" required>
          <option value="pix">Pix</option>
          <option value="cartao">Cartão</option>
          <option value="boleto">Boleto</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Finalizar Pedido</button>
    </form>
  <?php endif; ?>
</body>
</html>
