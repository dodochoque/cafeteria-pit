<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['admin'])) { header('Location: /admin/login.php'); exit; }

require_once __DIR__ . '/../models/DB.php';

$db = DB::conexao();
$sql = "SELECT p.id_pedido, p.data_pedido, p.status,
               c.nome AS cliente, c.email,
               COALESCE(SUM(i.total_item), 0) AS total,
               pg.metodo, pg.status_pagamento
        FROM pedidos p
        JOIN clientes c ON c.id_cliente = p.id_cliente
        LEFT JOIN itens_pedido i ON i.id_pedido = p.id_pedido
        LEFT JOIN pagamentos pg ON pg.id_pedido = p.id_pedido
        GROUP BY p.id_pedido
        ORDER BY p.id_pedido DESC";
$rows = $db->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Admin - Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <div class="d-flex justify-content-between align-items-center">
    <h1>Pedidos</h1>
    <a href="/admin/logout.php" class="btn btn-outline-danger">Sair</a>
  </div>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>#</th>
        <th>Data</th>
        <th>Cliente</th>
        <th>E-mail</th>
        <th>Total</th>
        <th>Pagamento</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($rows as $r): ?>
      <tr>
        <td><?= (int)$r['id_pedido'] ?></td>
        <td><?= htmlspecialchars($r['data_pedido']) ?></td>
        <td><?= htmlspecialchars($r['cliente']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td>R$ <?= number_format($r['total'], 2, ',', '.') ?></td>
        <td><?= htmlspecialchars($r['metodo'] ?? '-') ?></td>
        <td><?= htmlspecialchars($r['status_pagamento'] ?? '-') ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="/index.php" class="btn btn-secondary mt-3">Voltar ao site</a>
</body>
</html>
