<?php
session_start();
require_once 'conexion.php'; // Asegúrate de tener este archivo creado

if (!isset($_SESSION['email_usuario'])) {
    header("Location: validar_compra.php");
    exit;
}

$email = $_SESSION['email_usuario'];
$metodo = $_POST['metodo_pago'] ?? 'Desconocido';

if (isset($_FILES['comprobante'])) {
    $file = $_FILES['comprobante'];

    $permitidos = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024;

    if (!in_array($file['type'], $permitidos)) {
        echo "❌ Tipo de archivo no permitido.";
        exit;
    }

    if ($file['size'] > $maxSize) {
        echo "❌ Archivo muy grande. Máximo permitido: 5 MB.";
        exit;
    }

    $nombreArchivo = time() . '_' . basename($file['name']);
    $ruta = 'comprobantes/' . $nombreArchivo;

    if (move_uploaded_file($file['tmp_name'], $ruta)) {
        // Insertar en base de datos
        $stmt = $conn->prepare("INSERT INTO pagos (email, metodo_pago, archivo_comprobante) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $metodo, $nombreArchivo);

        if ($stmt->execute()) {
            echo "<h2>✅ Comprobante recibido y registrado correctamente.</h2>";
            echo "<p>Gracias, <strong>" . htmlspecialchars($email) . "</strong></p>";
            echo "<p><a href='index.php'>Volver a la tienda</a></p>";
        } else {
            echo "❌ Error al registrar en la base de datos.";
        }
        $stmt->close();
    } else {
        echo "❌ Error al guardar el archivo.";
    }
} else {
    echo "❌ No se recibió ningún archivo.";
}
?>
