<?php

// conexion.php

// Configuración de la conexión a MySQL con PDO
$host = 'localhost';
$db = 'adr_sigci_amdelca';
$user = 'root';
$pass = 'ingmorales';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error en la conexión: '.$e->getMessage());
}
