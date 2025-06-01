<?php
// PASO 1: Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// PASO 2: Verificar si se recibió el ID del producto por POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["producto_id"])) {
  $productoId = intval($_POST["producto_id"]);

  // PASO 3: Ejecutar la eliminación del producto del carrito
  $sql = "DELETE FROM carrito WHERE producto_id = $productoId";

  if ($conn->query($sql) === TRUE) {
    // Redirige al carrito actualizado
    header("Location: ver_carrito.php");
    exit();
  } else {
    echo "Error al eliminar: " . $conn->error;
  }
} else {
  echo "Acceso no autorizado.";
}

$conn->close();
?>
