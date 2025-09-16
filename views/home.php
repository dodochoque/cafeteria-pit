<?php require_once __DIR__.'/../models/Produto.php'; ?>
<!DOCTYPE html><html lang="pt-br"><head>
<meta charset="utf-8"><title>Cafeteria Gourmet</title></head>
<body>
<h1>Cafeteria Gourmet - Cardápio</h1>
<ul>
<?php foreach(Produto::listarAtivos() as $p): ?>
<li><?= htmlspecialchars($p['nome']) ?> - R$ <?= number_format($p['preco'],2,',','.') ?>
<form method="post" action="/adicionar">
<input type="hidden" name="id_produto" value="<?= $p['id_produto'] ?>">
<input type="number" name="quantidade" value="1" min="1">
<button type="submit">Adicionar</button></form></li>
<?php endforeach; ?>
</ul>
</body></html>