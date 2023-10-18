<?php
$cod = $_GET['cod'];

$conexion = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
$consulta = $conexion->stmt_init();

if ($_POST) {
    $consultaTemp = $conexion->stmt_init();
    $consultaTemp2 = $conexion->stmt_init();
    $consultaTemp->prepare('SELECT t.nombre FROM `stock` s inner join `tienda` t ON s.tienda = t.cod WHERE producto = ?;');
    $consultaTemp->bind_param('s', $cod);
    $consultaTemp->execute();
    $consultaTemp->bind_result($tienda);
    $consultaTemp->store_result();

    while ($consultaTemp->fetch()) {
        $consultaTemp2->prepare('UPDATE stock SET unidades=? WHERE producto=? AND tienda=(SELECT cod from tienda where tienda.nombre=?);');
        $consultaTemp2->bind_param('sss', $_POST[$tienda], $cod, $tienda);
        $consultaTemp2->execute();
        $consultaTemp2->fetch();
    }
    $consultaTemp->close();
    $consultaTemp2->close();
    header('Location: ./main.php');
}
$consulta->prepare('SELECT producto, t.nombre, unidades FROM `stock` s inner join `tienda` t ON s.tienda = t.cod WHERE producto = ?;');
$consulta->bind_param('s', $cod);
$consulta->execute();
$consulta->bind_result($cod, $tienda, $unidades);

$consulta->fetch();
echo 'Producto: ' . $cod . '<br>';
echo '<strong>Stock del producto en las tiendas:</strong><br>';

if ($consulta) {
    echo '<form action="#" method="post">
        <label for="' . $tienda . '"> Tienda ' . $tienda . ': <label>
        <input type=number required name="' . $tienda . '" id="' . $tienda . '" value="' . $unidades . '"> unidades.<br>';

    while ($consulta->fetch()) {
        echo '<label for="' . $tienda . '"> Tienda ' . $tienda . ': <label>
        <input type=number required name="' . $tienda . '" id="' . $tienda . '" value="' . $unidades . '"> unidades.<br>';
    }

    echo '<input type="submit" name="send" id="send">
        </form>';
}
$consulta->close();


?>