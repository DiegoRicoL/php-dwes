<?php

include_once("User.php");
    if($_POST){
        $n_usuario = $_POST['usuario'];
        $n_contra = $_POST['password'];

        $statusLoginUser = User::loginUser($n_usuario, $n_contra);
        if($statusLoginUser){
            session_start();
            $_SESSION['user'] = $n_usuario;
            $_SESSION['password'] = $n_contra;
            header('Location: ./profile.php');
        } else {
            echo 'Login Incorrecto';
        }

    }else{
        session_start();
        if($_SESSION){
            echo 'Deseas iniciar sesion con el usuario '. $_SESSION['user'];
            echo '<form action="#" method="GET">';
            echo '<input id="reg-mod" type="submit" name="btnSi" value="Si"/>';
            echo '<input id="reg-mod" type="submit" name="btnNo" value="No"/>';
            echo '</form>';
            if(isset($_GET['btnSi']) || isset($_GET['btnNo'])){
                if($_GET['btnSi'] == "Si"){
                    header('Location: ./index.php');
                }else{
                    session_destroy();
                    header('Location: ./login.php');
                }
            }
        }else{
            enseñarLogin();
        }
    }


    function enseñarLogin(){
        echo '<h1> Login</h1>';
        echo '<form action="#" method="post">';
		echo '<label name="usuario">Usuario: </label>';
        echo '<input type="text" required name="usuario" placeholder="" /><br>';
		echo '<label for="password">Contraseña: </label>';
        echo '<input type="password" required name="password" placeholder="" /><br>';
		echo '<input id="reg-mod" type="submit" value="Login"/>';
        echo '<button onClick=location.href="./registro.php">Registro</button>';
		echo '</form>';
    }
?>