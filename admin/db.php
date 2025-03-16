<?php
$servidor="localhost";
$BaseDeDatos="toluca_inv";
$usuario="root";
$password="";
$puerto="33065"; // Agregar el puerto correcto

try {
    $conexion = new PDO("mysql:host=$servidor;port=$puerto;dbname=$BaseDeDatos;charset=utf8", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    die("Error en la conexión a la base de datos: " . $error->getMessage());
}
?>
