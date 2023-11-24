<?php

class Conexion
{
    private static $conexion;

    public function __construct()
    {
        self::init();
    }


    public static function init()
    {
        self::$conexion = new PDO('mysql:host=localhost;dbname=usuariosfotos', 'fotos', 'fotos');
    }

    public static function loginUser($name, $password)
    {
        $datosUsuario = self::getUserByName($name);
        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario['contrasena'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public static function getUserByName($name)
    {
        $consulta = self::$conexion->prepare('SELECT * from usuarios where nombre="' . $name . '";');
        $consulta->execute();
        $datosUsuario = $consulta->fetch(PDO::FETCH_ASSOC);
        return $datosUsuario;
    }

    public static function createUser($name, $password, $imagenSmall, $imagenBig)
    {
        $consulta = self::$conexion->prepare('INSERT into usuarios(nombre, contrasena, imagenBig, imagenSmall) VALUES(?,?, ?, ?)');
        $consulta->bindParam(1, $name);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $consulta->bindParam(2, $hash);
        $consulta->bindParam(3, $imagenBig);
        $consulta->bindParam(4, $imagenSmall);
        
        $ok = true;
        self::$conexion->beginTransaction();
        if ($consulta->execute() === 0) {
            $ok = false;
        }

        if ($ok) {
            self::$conexion->commit();
        } else {
            self::$conexion->rollBack();
        }
    }
}

Conexion::init();

?>