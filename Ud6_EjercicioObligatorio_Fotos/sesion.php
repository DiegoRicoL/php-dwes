<?php
include_once("User.php");
session_start();

if (!$_SESSION) {
    header("Location: ./login.php");
} else {
    if (isset($_POST['close'])) {
        session_destroy();
        header("Location: ./login.php");
    } else {

        $datosUsuario = User::getUserByName($_SESSION['user']);

        echo '<img src="' . $datosUsuario['imagenSmall'] . '" alt="Foto de perfil" width="72" height="96">';

        echo '<form method="post"> 
            <input type="submit" name="close"
            value="Cerrar Sesion"/> 
        </form>';
    }
}
?>