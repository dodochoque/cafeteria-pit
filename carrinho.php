<?php
// carrinho.php
if (session_status() === PHP_SESSION_NONE) {
    session_name("cafeteria_sessao");
    session_start();
}

require_once __DIR__ . '/models/Produto.php';

// Base para links portáteis (localhost e InfinityFree)
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

// Ações do carrinho
$acao = $_GET['acao'] ?? '';
if ($acao === 'limpar') {
    unset($_SESSION['carrinho']);
    header('Location: ' . $base . 'carrinho.php');
    exit;
}
if ($acao === 'remover') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id && isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
        if (empty($_SESSION['carrinho'])) {
            unset($_SESSION['carrinho']);
        }
    }
    header('Location: ' . $base . 'carrinho.php');
    exit;
}

$carrinho = $_SESSION['carrinho'] ?? [];
$itens = [];
$total = 0.0;

foreach ($carrinho as $id_produto => $qtd) {
    $prod = Produto::obterPorId($id_produto);
    if ($prod) {
        $preco = (float)$prod['preco'];
        $qtd   = max(1, (int)$qtd);
        $subtotal = $preco * $qtd;
        $total += $subtotal;
        $itens[] = [
            'id' => (int)$id_produto,
            'nome' => $prod['nome'],
            'qtd' => $qtd,
            'preco' => $preco,
            'subtotal' => $subtotal
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrinho – Dianita Café</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-4">Carrinho de Compras</h1>

  <?php if (empty($itens)): ?>
    <div class="alert alert-info">Seu carrinho está vazio.</div>
    <a href="<?= $base ?>index.php" class="btn btn-primary">Voltar ao Cardápio</a>

  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Produto</th>
            <th style="width:120px">Qtd</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
            <th style="width:120px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($itens as $i): ?>
            <tr>
              <td><?= htmlspecialchars($i['nome']) ?></td>
              <td><?= (int)$i['qtd'] ?></td>
              <td>R$ <?= number_format($i['preco'], 2, ',', '.') ?></td>
              <td>R$ <?= number_format($i['subtotal'], 2, ',', '.') ?></td>
              <td>
                <!-- Remover item (opcional) -->
                <a class="btn btn-sm btn-outline-danger"
                   href="<?= $base ?>carrinho.php?acao=remover&id=<?= (int)$i['id'] ?>"
                   onclick="return confirm('Remover este item?');">
                  Remover
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Total:</th>
            <th colspan="2">R$ <?= number_format($total, 2, ',', '.') ?></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="d-flex flex-wrap gap-2">
      <!-- Esvaziar carrinho -->
      <a href="<?= $base ?>carrinho.php?acao=limpar"
         class="btn btn-outline-danger"
         onclick="return confirm('Tem certeza que deseja esvaziar o carrinho?');">
        Esvaziar carrinho
      </a>

      <!-- Continuar comprando -->
      <a href="<?= $base ?>index.php" class="btn btn-outline-secondary">
        Continuar comprando
      </a>

      <!-- Finalizar compra -->
      <a href="<?= $base ?>checkout.php" class="btn btn-success">
        Finalizar compra
      </a>
    </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
