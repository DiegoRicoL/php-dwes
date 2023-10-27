<?php
    	$discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');
        $consultaDiscos = $discografia->prepare('SELECT * from album;');

        $consultaDiscos->execute();

        while(($resultado = $consultaDiscos->fetch(PDO::FETCH_ASSOC)) != null) {
            echo 'Titulo: ' . $resultado['titulo'] . ' Discografía: ' . $resultado['discografia'] . ' Formato: ' . $resultado['formato'] . ' Fecha de Lanzamiento: ' . $resultado['fechaLanzamiento'] . '<a href="./disco.php?cod=' . $resultado['cod'] . '"> Ir al Album </a> <br>';
        }

        echo '<br><br><a href="./disconuevo.php"> Agregar nuevo disco </a>';
        echo '<a href="./canciones.php"> Buscador de canciones </a>';

?>