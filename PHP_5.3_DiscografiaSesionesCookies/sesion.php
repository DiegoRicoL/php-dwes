<?php
session_start();

if (!$_SESSION) {
    header("Location: ./login.php");
} else {
    if(isset($_POST['close'])){
        session_destroy();
        header("Location: ./login.php");
    } else {
        echo '<form method="post"> 
            <input type="submit" name="close"
            value="Cerrar Sesion"/> 
        </form>';
    }
}
?>