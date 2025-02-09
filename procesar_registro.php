<?php
// Habilitar la visualización de errores (opcional, para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión
include 'conexion.php';

// Recoger los datos enviados por el formulario
$nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($email) || empty($password)) {
    die("Todos los campos son obligatorios. <a href='registro.html'>Volver</a>");
}

// Validar el formato del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El email no es válido. <a href='registro.html'>Volver</a>");
}

// Hashear la contraseña para mayor seguridad
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar la sentencia SQL para evitar inyección de SQL
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
if (!$stmt) {
    die("Error en la preparación: " . $conn->error);
}
$stmt->bind_param("sss", $nombre, $email, $hashed_password);

// Ejecutar la consulta e informar al usuario
if ($stmt->execute()) {
    echo "Usuario registrado exitosamente. <a href='registro.html'>Registrar otro</a>";
} else {
    // Si el email ya existe, por ejemplo, mostrará un error
    echo "Error al registrar el usuario: " . $stmt->error . ". <a href='registro.html'>Volver</a>";
}

$stmt->close();
$conn->close();
?>
