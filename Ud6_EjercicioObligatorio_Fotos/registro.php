<?php
include_once("User.php");

if ($_POST) {
    $n_usuario = $_POST['usuario'];
    $n_contra = $_POST['password'];
    $n_foto = $_FILES['foto'];

    var_dump($_FILES['foto']);

    if ($_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/png') {
        if ($_FILES['foto']['error'] != UPLOAD_ERR_OK) { // Se comprueba si hay un error al subir el archivo
            echo 'Error: ';
            switch ($_FILES['foto']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo 'El fichero es demasiado grande';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo 'El fichero no se ha podido subir entero';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo 'No se ha podido subir el fichero';
                    break;
                default:
                    echo 'Error indeterminado.';
            }
            exit();
        }

        $sizeImage = getimagesize($_FILES['foto']['tmp_name']); // Se obtiene el tamaño del archivo
        if($sizeImage[0] > 360 || $sizeImage[1] > 480){ // Se comprueba si el tamaño es mayor que 1000px
            echo 'El tamaño de la imagen es demasiado grande';
            exit();
        }

        if (!is_dir('img/users/' . $n_usuario)) { // Se comprueba si existe el directorio de usuario
            mkdir('img/users/' . $n_usuario, 0777, true); // Se crea el directorio de usuario
        }

        $imagen = $_FILES['foto'];

        $ancho = $sizeImage[0];
        $alto = $sizeImage[1];

        $nuevoAncho = 360;
        $nuevoAlto = 480;

        $thumb = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        switch ($_FILES['foto']['type']) {
            case 'image/jpg':
                $source = imagecreatefromjpeg($imagen['tmp_name']);
                break;
            case 'image/png':
                $source = imagecreatefrompng($imagen['tmp_name']);
                break;
        }

        imagecopyresized($thumb, $source, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

        $path = 'img/users/' . $n_usuario . '/' . $n_usuario . 'Big.png';
        imagepng($thumb, $path);
        $n_fotoGrande = $path;

        $nuevoAncho = 72;        
        $nuevoAlto = 96;

        $thumb = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

        $path = 'img/users/' . $n_usuario . '/' . $n_usuario . 'Small.png';
        imagepng($thumb, $path);

        $n_fotoPequeña = $path;

        if (User::getUserByName($n_usuario) == false) {
            User::createUser($n_usuario, $n_contra, $n_fotoGrande, $n_fotoPequeña);
            header('Location: ./login.php');
        } else {
            echo '<p>Ese usuario ya existe, vuelva a intentar registrarse</p>';
        }
    } else {
        echo 'El archivo no es una imagen';
    }


} else {
    enseñarRegistro();
}


function enseñarRegistro()
{
    echo '<h1>Registro</h1>';
    echo '<form action="#" method="post" enctype="multipart/form-data">';
    echo '<label name="usuario">Usuario: </label>';
    echo '<input type="text" required name="usuario" placeholder="" /><br>';
    echo '<label for="password">Contraseña: </label>';
    echo '<input type="password" required name="password" placeholder="" /><br>';
    echo '<input type="file" required name="foto" id="foto"/><br>';
    echo '<input id="reg-mod" type="submit" value="Registrar"/>';
    echo '</form>';
}


?>