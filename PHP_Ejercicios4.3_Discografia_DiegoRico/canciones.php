<?php

if($_POST){
    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');

    switch($_POST['busqueda']){
        case 'TituloCancion':
            $consulta = $discografia->prepare('SELECT * FROM cancion where titulo LIKE "%' . $_POST['texto'] . '%" AND genero LIKE "' . $_POST['genero'] . '";');
            $consulta->execute();

            while(($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) != null) {
                echo 'Titulo: ' . $resultado['titulo'] . ' Album: ' . $resultado['album'] . ' Posicion: ' . $resultado['posicion'] . ' Duracion: ' . $resultado['duracion'] . ' Genero: ' . $resultado['genero'] . '<a href="./disco.php?cod=' . $resultado['album'] . '"> Ir al Album </a> <br>';
            }
            break;
        case 'NombresAlbum':
            $consulta = $discografia->prepare('SELECT * FROM cancion where cancion.album=(SELECT album.cod FROM album where album.titulo LIKE "%' . $_POST['texto'] . '%");');
            $consulta->execute();

            while(($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) != null) {
                echo 'Titulo: ' . $resultado['titulo'] . ' Album: ' . $resultado['album'] . ' Posicion: ' . $resultado['posicion'] . ' Duracion: ' . $resultado['duracion'] . ' Genero: ' . $resultado['genero'] . '<a href="./disco.php?cod=' . $resultado['album'] . '"> Ir al Album </a> <br>';
            }
            break;
        case 'Ambos':
            $consulta = $discografia->prepare('SELECT * FROM cancion where cancion.album=(SELECT album.cod FROM album where album.titulo LIKE "%' . $_POST['texto'] . '%" ) OR cancion.titulo LIKE "%' . $_POST['texto'] . '%" AND cancion.genero LIKE "' . $_POST['genero'] . '";');
            $consulta->execute();

            while(($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) != null) {
                echo 'Titulo: ' . $resultado['titulo'] . ' Album: ' . $resultado['album'] . ' Posicion: ' . $resultado['posicion'] . ' Duracion: ' . $resultado['duracion'] . ' Genero: ' . $resultado['genero'] . '<a href="./disco.php?cod=' . $resultado['album'] . '"> Ir al Album </a> <br>';
            }
            break;
        default:
            break;
    }
} else {
    echo '<h1>Búsqueda de canciones</h1>';

    echo '<form action="#" method="post">
            <label for="texto">Texto a buscar: </label>
            <input type="text" required name="texto"/><br>

            <label for="tituloCancion">Titulos de Cancion</label>
            <input type="radio" name="busqueda" id="tituloCancion" value="TituloCancion">
            <label for="nombresAlbum">Nombres de Album</label>
            <input type="radio" name="busqueda" id="nombresAlbum" value="NombresAlbum">
            <label for="ambos">Ambos</label>
            <input type="radio" name="busqueda" id="ambos" value="Ambos"><br>

            <label for="genero">Genero musical:</label>
            <select name="genero">
                <option>Clasica</option>
                <option>BSO</option>
                <option>Blues</option>
                <option>Electronica</option>
                <option>Jazz</option>
                <option>Metal</option>
                <option>Pop</option>
                <option>Rock</option>
            </select><br>
            <input id="reg-mod" type="submit" value="Buscar"/><br>
        </form>
        
        <button  onclick=location.href="./index.php">Volver al inicio</button>';
}

?>