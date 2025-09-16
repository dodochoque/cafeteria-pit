<?php
require_once __DIR__.'/DB.php';
class Produto {
  public static function listarAtivos() {
    $sql = "SELECT * FROM produtos WHERE ativo=1 ORDER BY nome";
    return DB::conn()->query($sql)->fetchAll();
  }
  public static function obterPorId($id) {
    $st = DB::conn()->prepare("SELECT * FROM produtos WHERE id_produto=?");
    $st->execute([$id]); return $st->fetch();
  }
}