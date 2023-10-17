<?php
    $conexion = new mysqli('localhost', 'agenda2', 'agenda', 'agenda');
    $consulta = $conexion->stmt_init();
    $consulta->prepare('SELECT * from contacto;');
    $consulta->execute();
    $consulta->bind_result($idContacto, $nombre, $apellido1, $apellido2, $telefono);

    
    while ($consulta->fetch()) {
        echo 'IdContacto: ' . $idContacto . ' Nombre: ' . $nombre . ' Apellido 1: ' . $apellido1 . ' Apellido2: ' . $apellido2 . ' Tlf: ' . $telefono . '<a href="./contactonuevo.php?action=UPDATE&idContacto=' . $idContacto . '" > MODFIFICAR </a>' . '<a href="./contactonuevo.php?action=DELETE&idContacto=' . $idContacto . '" > BORRAR </a> <br>';
    }

    $consulta->close();
?>