<?php
$discografia = new PDO('mysql:host=localhost;dbname=discografia', 'agenda2', 'agenda');
$consulta = $discografia->prepare('INSERT into tabla_usuarios(usuario,password) VALUES(?,?)');
$n_nombre = 'Diego';
$consulta->bindParam(1, $n_nombre);
$pass = 'diego';
$hash = password_hash($pass, PASSWORD_DEFAULT);
$consulta->bindParam(2, $hash);
$consulta->execute();
?>