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

function insertar($conexion, $nombre, $ape1, $ape2, $tlf)
{
    $consulta = $conexion->stmt_init();
    $consulta->prepare('INSERT INTO contacto(nombre, apellido1, apellido2, telefono) VALUES(?, ?, ?, ?);');
    $consulta->bind_param('sssi', $nombre, $ape1, $ape1, $tlf);
    $consulta->execute();
    $consulta->close();
}

function modificar($conexion, $nombre, $ape1, $ape2, $tlf, $cod){
    $consulta = $conexion->stmt_init();
    $consulta->prepare('UPDATE contacto SET nombre=?, apellido1=?, apellido2=?, telefono=? where cod=?;');
    $consulta->bind_param('sssii', $nombre, $ape1, $ape1, $tlf, $cod);
    $consulta->execute();
    $consulta->close();
}

function borrar($conexion, $idContacto)
{
    $consulta = $conexion->stmt_init();
    $consulta->prepare("DELETE from contacto where cod=?;");
    $consulta->bind_param('i', $idContacto);
    $consulta->execute();

    if ($consulta) {
        try {
            header("Location: ./contactonuevo.php");
        } catch (\Throwable $th) {
            echo 'Ha ocurrido un error inesperado';
        }
    }
    $consulta->close();
}

if($_GET){
    if($_GET['action'] === "DELETE"){
        borrar($conexion, $_GET['idContacto']);
    } elseif($_GET['action'] === "UPDATE"){
        $consulta = $conexion->stmt_init();
        $consulta->prepare('SELECT * from contacto where cod=?;');
        $consulta->bind_param('i', $_GET['idContacto']);
        $consulta->execute();
        $consulta->bind_result($cod, $datos['nombre'], $datos['apellido1'], $datos['apellido2'], $datos['telefono']);
        $consulta->fetch();
        $consulta->close();
    }
}


if ($_POST) {
    $regexName = '~[0-9]+~';
    $regexMail = '/^\\S+@\\S+\\.\\S+$/';

    if (preg_match($regexName, $_POST['nombre']) || preg_match($regexName, $_POST['apellido1']) || (preg_match($regexName, $_POST['apellido2']))) {
        $errorName = !$errorName;
    }

    if ($errorName == false && $errorPhone == false) {
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

    echo '<form action="#" method="post">
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

    if($_GET['action'] === "UPDATE"){
        modificar($conexion, $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['telefono'], $_GET['idContacto']);
    } else {
        insertar($conexion, $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['telefono']);
    }
    header("Location: ./contactonuevo.php");
}


include('footerContactos.inc.php');

?>