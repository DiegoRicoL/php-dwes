<?php
include("sesion.php");
$discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');

if ($_POST) {
    try {
        $insertCancion = $discografia->prepare('INSERT INTO album (titulo, discografia, formato) VALUES (:titulo, :discografia, :formato);');
        $insertCancion->bindParam(':titulo', $_POST['titulo']);
        $insertCancion->bindParam(':discografia', $_POST['discografia']);
        $insertCancion->bindParam(':formato', $_POST['formato']);

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
        echo var_dump($_POST);
        echo 'Ha habido un error con la inserción del disco';
        $discografia->rollBack();
    }

} else {
    echo '<h1> FORMULARIO PARA AÑADIR ALBUMES</h1>';
    echo '<form action="#" method="post">
            <label for="titulo">Titulo: </label>
            <input type="text" required name="titulo" placeholder="Título" />
            <label for="discografia">Discografía: </label>
            <input type="text" name="discografia" />
            <label for="formato">Formato: </label>
            <select name="formato">
                <option> vinilo</option>
                <option> cd</option>
                <option> dvd</option>
                <option> mp3</option>
            </select>
            <input id="reg-mod" type="submit" value="Añadir"/>
        </form>
        
        <button  onclick=location.href="./index.php">Volver al inicio</button>';
}


?>;