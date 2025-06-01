<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"] ?? '';
    $email = $_POST["email"] ?? '';

    $esAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    $success = false;
    $message = "";

    // Validar contraseña (puedes usar base de datos en producción)
    if ($password === "123456") {
        $success = true;
        $message = "Contraseña correcta.";

        // Guardar usuario en sesión
        $_SESSION['user'] = $email;
        $_SESSION['email_usuario'] = $email;

        // Opcional: inicializar carrito y método pago si no existen
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];  // O lo que uses para carrito
        }
        if (!isset($_SESSION['metodo_pago'])) {
            $_SESSION['metodo_pago'] = '';  // Inicializar vacío o valor por defecto
        }
    } else {
        $message = "Contraseña incorrecta. Intenta de nuevo.";
    }

    if ($esAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => $success, 'message' => $message]);
        exit;
    } else {
        // Si no es AJAX, hacer redirect o mostrar error
        if ($success) {
            header("Location: confirmar_pago.php");
            exit;
        } else {
            echo "<script>alert('{$message}'); window.location.href='validar_compra.php';</script>";
            exit;
        }
    }
}
?>
