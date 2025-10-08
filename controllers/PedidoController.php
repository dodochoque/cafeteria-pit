<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name("cafeteria_sessao");
    session_start();
}
require_once __DIR__ . '/../models/Produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_VALIDATE_INT);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
    if (!$quantidade || $quantidade < 1) $quantidade = 1;

    if ($id_produto) {
        if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
        if (isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto] += $quantidade;
        } else {
            $_SESSION['carrinho'][$id_produto] = $quantidade;
        }
    }
    header('Location: /carrinho.php');
    exit;
} else {
    header('Location: /index.php');
    exit;
}
