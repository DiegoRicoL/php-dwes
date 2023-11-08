<?php
include("sesion.php");
if ($_GET) {
    $codAlbum = $_GET['cod'];

    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');

    $consultaCanciones = $discografia->prepare('SELECT * from cancion WHERE album=:cod;');
    $consultaCanciones->bindParam(':cod', $codAlbum);
    $consultaCanciones->execute();

    while (($resultado = $consultaCanciones->fetch(PDO::FETCH_ASSOC)) != null) {
        echo 'Titulo: ' . $resultado['titulo'] . ' Album: ' . $resultado['album'] . ' Posición: ' . $resultado['posicion'] . ' Duracion: ' . $resultado['duracion'] . ' Genero: ' . $resultado['genero'] . '<br>';
    }

    echo '<br><br> <a href="./cancionnueva.php?cod=' . $codAlbum . '"> Añadir Cancion al Album</a>';
    echo '<br><a href="./borrardisco.php?cod=?cod=' . $codAlbum . '"> Eliminar Album y todas sus canciones </a>';
}

?>