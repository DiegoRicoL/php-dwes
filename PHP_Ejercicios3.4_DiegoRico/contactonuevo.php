<?php
    $conexion = new mysqli('localhost', 'agenda2', 'agenda', 'agenda');

    $todoOK = false;

    $errorName = false;
    $errorPhone = false;

    $datos = array(
        "nombre" => "",
        "apellido1" => "",
        "apellido2" => "",
        "telefono" => 0
    );


    if ($_POST) {
        $regexName = '~[0-9]+~';
        $regexMail = '/^\\S+@\\S+\\.\\S+$/';

        if (preg_match($regexName, $_POST['nombre']) || preg_match($regexName, $_POST['apellido1']) || (preg_match($regexName, $_POST['apellido2']))) {
            $errorName = !$errorName;
        }

        if($errorName == false && $errorPhone == false){
            $todoOK = true;
        }
    }


    if ($todoOK == false) {
        if (isset($_POST['nombre'])) {
            $datos['nombre'] = $_POST['nombre'];
        }
        if (isset($_POST['apellido1'])) {
            $datos['apellido1'] = $_POST['apellido1'];
        }
        if (isset($_POST['apellido2'])) {
            $datos['apellido2'] = $_POST['apellido2'];
        }

        if (isset($_POST['telefono'])) {
            $datos['telefono'] = $_POST['telefono'];
        }

        echo '<form action="contactonuevo.php" method="post">
                <fieldset>
                    <legend>Datos Personales</legend>
                    <label for="nombre">Nombre</label>
                    <input type="text" required name="nombre" id="nombre" value="' . $datos['nombre'] . '">
                    <br>
                    <label for="apellido1">Primer Apellido</label>
                    <input type="text" required name="apellido1" id="apellido1" value="' . $datos['apellido1'] . '">
                    <br>
                    <label for="apellido2">Segundo Apellido</label>
                    <input type="text" required name="apellido2" id="apellido2" value="' . $datos['apellido2'] . '">';
        if ($errorName) {
            echo '<h3>Hay un problema con tu nombre</h3><br>';
        }

        echo '<label for="telefono">Telefono</label>
                    <input type="number" required name="telefono" id="telefono" value="' . $datos['telefono'] . '">';

        if ($errorPhone) {

            echo '<h3>Hay un problema con tu telefono</h3><br>';
        }

        echo '<input type="submit" name="send" id="send">
              </fieldset>
            </form>';

    } else {
        @$conexion->query('INSERT INTO contacto(nombre, apellido1, apellido2, telefono) VALUES("' . $_POST['nombre'] . '", "' . $_POST['apellido1'] . '", "' . $_POST['apellido2'] . '", ' . $_POST['telefono'] . ');');
        echo '<h2>Formulario enviado correctamente</h2>';
    }


    include('footerContactos.inc.php');

?>