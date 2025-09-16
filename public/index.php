<?php
require_once __DIR__.'/../controllers/PedidoController.php';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if($path==='/adicionar'){ (new PedidoController())->adicionarAoCarrinho(); exit; }
include __DIR__.'/../views/home.php';
