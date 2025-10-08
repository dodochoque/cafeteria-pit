<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$erro = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    if ($senha === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: /admin/pedidos.php');
        exit;
    } else {
        $erro = "Senha inválida";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - Dianita Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Admin - Login</h1>
  <?php if($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Senha</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
  </form>
</body>
</html>
