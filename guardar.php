<?php
// Conexión a la base de datos MySQL
$host = 'localhost';       // Servidor local
$user = 'freddy';            // Usuario de base de datos
$pass = 'freddyps19';                // Contraseña (vacía por defecto en local)
$db = 'andrew_camisetas_de_futbol';  // Nombre de la base de datos

if ($conexion->connect_error) {
  die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO cliente (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";

if ($conexion->query($sql) === TRUE) {
  echo "Mensaje enviado correctamente.";
} else {
  echo "Error: " . $conexion->error;
}

$conexion->close();
?>
