<?php
require_once __DIR__ . '/DB.php';

class Produto {
    public static function listarTodos() {
        $db = DB::conexao();
        $sql = "SELECT id_produto, nome, categoria, preco FROM produtos WHERE ativo = 1 ORDER BY nome";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function obterPorId($id) {
        $db = DB::conexao();
        $stmt = $db->prepare("SELECT id_produto, nome, preco FROM produtos WHERE id_produto = ? AND ativo = 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
