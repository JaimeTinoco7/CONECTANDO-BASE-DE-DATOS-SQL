<?php
// Datos de conexión
$servername = "localhost";
$username   = "root";      // Usuario de MySQL (por defecto, en XAMPP suele ser "root")
$password   = "";          // Contraseña (en XAMPP por defecto es vacía)
$dbname     = "ejemploa_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
