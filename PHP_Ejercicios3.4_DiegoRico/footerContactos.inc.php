<?php
    $consulta = 'Select * from contacto';
    $conexion = new mysqli('localhost', 'agenda2', 'agenda', 'agenda');
    $resultado = $conexion->query($consulta);

    $infoContactos = $resultado->fetch_object();
    while ($infoContactos != null) {
        echo 'IdContacto: ' . $infoContactos->cod . ' Nombre: ' . $infoContactos->nombre . ' Apellido 1: ' . $infoContactos->apellido1 . ' Apellido2: ' . $infoContactos->apellido2 . ' Tlf: ' . $infoContactos->telefono . '<a href="./borrarContacto.php?idContacto=' . $infoContactos->cod . '" > BORRAR </a> <br>';
        $infoContactos = $resultado->fetch_object();
    }
?>