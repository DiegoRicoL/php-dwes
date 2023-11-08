<?php
include("sesion.php");
$discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');

if ($_POST) {
    try {
        $insertCancion = $discografia->prepare('INSERT INTO cancion VALUES (:titulo, :album, :posicion, :duracion, :genero);');
        $insertCancion->bindParam(':titulo', $_POST['titulo']);
        $insertCancion->bindParam(':album', $_GET['cod']);
        $insertCancion->bindParam(':posicion', $_POST['posicion']);
        $insertCancion->bindParam(':duracion', $_POST['duracion']);
        $insertCancion->bindParam(':genero', $_POST['genero']);

        $ok = true;
        $discografia->beginTransaction();
        if ($insertCancion->execute() === 0) {
            $ok = false;
        }

        if ($ok) {
            $discografia->commit();
        } else {
            $discografia->rollBack();
        }

        header('Location: ./index.php');
    } catch (Exception $e) {
        echo 'Ha habido un error con la inserción de la canción';
        $discografia->rollBack();
    }

} else {
    if ($_GET) {
        $codAlbum = $_GET['cod'];

        $consultaCanciones = $discografia->prepare('SELECT * from album WHERE cod=:cod;');
        $consultaCanciones->bindParam(':cod', $codAlbum);
        $consultaCanciones->execute();

        $tituloDisco = $consultaCanciones->fetch(PDO::FETCH_ASSOC);

        echo '<h1> FORMULARIO PARA AÑADIR CANCIONES</h1>';
        echo '<h2>Crear nueva canción para ' . $tituloDisco['titulo'] . ' </h2>';
        echo '<form action="./cancionnueva.php?cod=' . $codAlbum . '" method="post">
            <label for="titulo">Titulo: </label>
            <input type="text" required name="titulo" placeholder="Título" />
            <input type="hidden" name="album" placeholder="' . $codAlbum . '">
            <label for="posicion"l>Posición: </label>
            <input type="number" min=0 name="posicion" value=0 />
            <label for="duracion">Duración: </label>
            <input type="time" name="duracion" step="1"/>
            <label for="genero">Género: </label>
            <select name="genero">
                <option> Clasica</option>
                <option> BSO</option>
                <option> Blues</option>
                <option> Folk</option>
                <option> Jazz</option>
                <option> New age</option>
                <option> Pop</option>
                <option> Rock</option>
                <option> Electronica</option>
            </select>
            <input id="reg-mod" type="submit" value="Añadir"/>
        </form>
        
        <button  onclick=location.href="./index.php">Volver al inicio</button>';
    }

}

?>