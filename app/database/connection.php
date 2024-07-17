<?php

/**
 * Classe criada para estabelecer a conexão com o banco de dados
 */

abstract class Connection
{
    
    private static $connectionPDO;

    protected static $host = "localhost";
    protected static $user = "root";
    protected static $pass = "";
    protected static $dbname = "empresa";
    protected static $port = "3307";

    public static function connect()
    {
        try {
            if (!self::$connectionPDO) {
                self::$connectionPDO = new PDO("mysql:host=".self::$host.";port=".self::$port.";dbname=".self::$dbname, self::$user, self::$pass, [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            }
            return self::$connectionPDO;
        } catch (PDOException $err) {
            json_decode($err->getMessage());
        }
    }
}
