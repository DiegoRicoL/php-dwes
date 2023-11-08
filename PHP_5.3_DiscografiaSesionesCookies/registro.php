<?php
if ($_POST) {
    $n_usuario = $_POST['usuario'];
    $n_contra = $_POST['password'];

    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'agenda2', 'agenda');
    $consulta = $discografia->prepare('SELECT usuario from tabla_usuarios where usuario="' . $n_usuario . '";');
    $consulta->execute();
    $existeUsuario = $consulta->fetch(PDO::FETCH_ASSOC);
    if (!$existeUsuario) {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'agenda2', 'agenda');
        $consulta = $discografia->prepare('INSERT into tabla_usuarios(usuario,password) VALUES(?,?)');
        $consulta->bindParam(1, $n_usuario);
        $hash = password_hash($n_contra, PASSWORD_DEFAULT);
        $consulta->bindParam(2, $hash);
        $consulta->execute();
        echo '<p>Usuario creado, proceda a iniciar sesión</p>';
    } else {    
        echo '<p>Ese usuario ya existe, vuelva a intentar registrarse</p>';
    }


} else {
    enseñarRegistro();
}


function enseñarRegistro()
{
    echo '<h1>Registro</h1>';
    echo '<form action="#" method="post">';
    echo '<label name="usuario">Usuario: </label>';
    echo '<input type="text" required name="usuario" placeholder="" /><br>';
    echo '<label for="password">Contraseña: </label>';
    echo '<input type="password" required name="password" placeholder="" /><br>';
    echo '<input id="reg-mod" type="submit" value="Registrar"/>';
    echo '</form>';
}


?>