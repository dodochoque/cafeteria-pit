<?php
require_once __DIR__.'/../models/Produto.php';
require_once __DIR__.'/../models/DB.php';
class PedidoController {
  public function adicionarAoCarrinho() {
    session_start();
    $id = (int)($_POST['id_produto'] ?? 0);
    $qtd = max(1,(int)($_POST['quantidade'] ?? 1));
    $prod = Produto::obterPorId($id);
    if(!$prod || !$prod['ativo']) { echo "Produto inválido"; return; }
    $_SESSION['carrinho'] = $_SESSION['carrinho'] ?? [];
    $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + $qtd;
    header("Location: /carrinho.php");
  }
}