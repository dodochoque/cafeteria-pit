<?php
class DB {
    private static $instancia = null;
    public static function conexao() {
        if (self::$instancia === null) {
            try {
                $host    = getenv('APP_DB_HOST') ?: 'localhost';
                $dbname  = getenv('APP_DB_NAME') ?: 'cafeteria_pit';
                $usuario = getenv('APP_DB_USER') ?: 'root';
                $senha   = getenv('APP_DB_PASS') ?: '';
                self::$instancia = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) { die("Erro de conexão: " . $e->getMessage()); }
        }
        return self::$instancia;
    }
}
