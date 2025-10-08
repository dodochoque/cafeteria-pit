<?php
require_once __DIR__ . '/../models/Produto.php';
$produtos = Produto::listarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dianita Café - Cardápio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-4">Dianita Café - Cardápio</h1>

  <div class="row">
    <?php foreach($produtos as $p): ?>
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
            <p class="card-text">Categoria: <?= htmlspecialchars($p['categoria']) ?></p>
            <p class="card-text">Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

            <form method="post" action="/controllers/PedidoController.php">
              <input type="hidden" name="id_produto" value="<?= (int)$p['id_produto'] ?>">
              <div class="mb-2">
                <label for="q<?= (int)$p['id_produto'] ?>">Quantidade:</label>
                <input type="number" name="quantidade" id="q<?= (int)$p['id_produto'] ?>" value="1" min="1" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Adicionar</button>
            </form>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <a href="/carrinho.php" class="btn btn-success mt-4">Ver Carrinho</a>
</body>
</html>
