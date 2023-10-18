<?php

$conexion = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
$consulta = $conexion->stmt_init();
$consulta->prepare('SELECT cod, nombre_corto, PVP, familia from producto;');
$consulta->execute();
$consulta->bind_result($cod, $nombre_corto, $pvp, $familia);
while($consulta->fetch()){
    echo 'Cod: ' . $cod . ' Nombre Corto: ' . $nombre_corto .' PVP: '. $pvp .' Familia: ' . $familia;
    echo '<a href="./stock.php?cod=' . $cod . '"> Ver stock </a> <br>';
}

$consulta->close();


?>