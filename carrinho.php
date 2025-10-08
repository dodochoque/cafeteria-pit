<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name("cafeteria_sessao");
  session_start();
}
require_once __DIR__ . '/models/Produto.php';
$carrinho = $_SESSION['carrinho'] ?? [];

function total_carrinho($carrinho) {
  $total = 0;
  foreach ($carrinho as $id => $qtd) {
    $p = Produto::obterPorId($id);
    if ($p) $total += ($p['preco'] * $qtd);
  }
  return $total;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Seu Carrinho - Dianita Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-4">Carrinho de Compras</h1>

  <?php if(empty($carrinho)): ?>
    <div class="alert alert-warning">Seu carrinho está vazio.</div>
    <a href="/index.php" class="btn btn-primary">Voltar ao Cardápio</a>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Qtd</th>
          <th>Preço</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($carrinho as $id => $qtd): ?>
          <?php $p = Produto::obterPorId($id); if(!$p) continue; ?>
          <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= (int)$qtd ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($p['preco'] * $qtd, 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total:</th>
          <th>R$ <?= number_format(total_carrinho($carrinho), 2, ',', '.') ?></th>
        </tr>
      </tfoot>
    </table>

    <a href="/index.php" class="btn btn-secondary">Continuar comprando</a>
    <a href="/checkout.php" class="btn btn-success">Finalizar Pedido</a>
  <?php endif; ?>
</body>
</html>
