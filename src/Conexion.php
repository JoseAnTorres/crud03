<?php

namespace Clases;

use PDO;
use PDOException;

class Conexion
{
    protected static $conexion;

    public function __construct()
    {
        if (self::$conexion == null) {
            self::conexion();
        }
    }

    public static function conexion()
    {
        //leer parametros de config
        $param = parse_ini_file('../.config');
        $base = $param["bbdd"];
        $user = $param["user"];
        $pass = $param["pass"];
        $host = $param["host"];
        //descriptor servidor con los parametros
        $dns = "mysql:host=$host;dbname=$base;charst=utf8mb4";
        //establecer conexion
        try {
            //pdo (dns, user, contraseña)
            self::$conexion = new PDO($dns, $user, $pass);
            //depuracion de errores
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //si falla la conexion
        } catch (PDOException $ex) {
            die("Error de conexion: " . $ex->getMessage());
        }
    }
}
