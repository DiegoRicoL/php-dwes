<?php

include_once("Conexion.php");

class User
{

    public function __construct()
    {
    }

    public static function createUser($name, $password, $imagenSmall, $imagenBig)
    {
        Conexion::createUser($name, $password, $imagenSmall, $imagenBig);
    }

    public static function loginUser($name, $password)
    {
        return Conexion::loginUser($name, $password);
    }

    public static function getUserByName($name)
    {
        return Conexion::getUserByName($name);
    }
}

?>