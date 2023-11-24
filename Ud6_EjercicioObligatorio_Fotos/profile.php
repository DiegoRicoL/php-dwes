<?php
    include("sesion.php");
    include_once("User.php");

    if(!isset($_SESSION['user'])){
        header('Location: ./login.php');
    }
    
    $datosUsuario = User::getUserByName($_SESSION['user']);

    echo '<h1> Bienvenido ' . $datosUsuario['nombre'] . '</h1>';
    echo '<img src="' . $datosUsuario['imagenBig'] . '" alt="Foto de perfil" width="360" height="480">';
?>