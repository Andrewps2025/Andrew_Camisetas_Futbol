<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Conectamos para eliminar productos del carrito
    $conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");
    if (!$conn->connect_error) {
        $sql = "DELETE FROM carrito WHERE usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}

// Limpiar variables de sesión
$_SESSION = [];
session_destroy();

// Redirigir al inicio
header("Location: index.php");
exit();
?>
