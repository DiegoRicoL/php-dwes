<?php
$idContacto = $_GET['idContacto'];

$conexion = new mysqli('localhost', 'agenda2', 'agenda', 'agenda');
$resultado = $conexion->query('SELECT * from contacto where cod="' . $idContacto . '"');

if ($resultado) {
    $resultado = "";
    $resultado = $conexion->query('DELETE from contacto where cod="' . $idContacto . '"');
}
if ($resultado) {
    try {
        header("Location: ./contactonuevo.php");
    } catch (\Throwable $th) {
        echo 'Ha ocurrido un error inesperado';
    }
}
?>