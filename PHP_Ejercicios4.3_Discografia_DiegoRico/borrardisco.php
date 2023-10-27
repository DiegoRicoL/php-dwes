<?php

$discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia');

if($_GET){
    try {

        $codAlbum = $_GET['cod'];

        $deleteCanciones = $discografia->prepare('DELETE FROM cancion where album=:cod');
        $deleteCanciones->bindParam(':cod', $codAlbum);

        $ok = true;
        $discografia->beginTransaction();
        if ($deleteCanciones->execute() === 0) {
            $ok = false;
        }

        if ($ok) {
            $discografia->commit();
        } else {
            $discografia->rollBack();
        }

        $deleteAlbum = $discografia->prepare('DELETE FROM album where cod=:cod');
        $deleteAlbum->bindParam(':cod', $codAlbum);

        $ok = true;
        $discografia->beginTransaction();
        if ($deleteAlbum->execute() === 0) {
            $ok = false;
        }

        if ($ok) {
            $discografia->commit();
        } else {
            $discografia->rollBack();
        }

    } catch (Exception $e) {
        echo 'Ha habido un error con la eliminación del albúm';
        $discografia->rollBack();
    }
}

?>