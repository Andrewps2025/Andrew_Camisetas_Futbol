<?php
// validar_confirmacion.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $codigo = $_POST['codigo'] ?? '';

    if (!$email || !$codigo) {
        exit("Faltan datos para validar la cuenta.");
    }

    $conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");
    if ($conn->connect_error) {
        exit("Error de conexión a la base de datos.");
    }

    $stmt = $conn->prepare("SELECT codigo_confirmacion, confirmado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($codigo_bd, $confirmado);

    if ($stmt->fetch()) {
        if ($confirmado == 1) {
            $mensaje = "<strong>✅ Tu cuenta ya estaba confirmada.</strong> ¡Vamos a la cancha!";
            $redirigir = false;
        } elseif ($codigo == $codigo_bd) {
            $stmt->close();
            $stmt = $conn->prepare("UPDATE usuarios SET confirmado = 1 WHERE email = ?");
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $mensaje = "<strong>🎉 ¡Felicidades Futbolero!</strong> Tu cuenta ha sido confirmada correctamente.";
                $redirigir = true;
            } else {
                $mensaje = "<strong>❌ Error al actualizar tu cuenta.</strong>";
                $redirigir = false;
            }
        } else {
            $mensaje = "<strong>⚠️ Código incorrecto.</strong> Por favor, intenta de nuevo.";
            $redirigir = false;
        }
    } else {
        $mensaje = "<strong>❌ Correo no encontrado.</strong>";
        $redirigir = false;
    }

    $stmt->close();
    $conn->close();
} else {
    exit("Método inválido.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Cuenta | Andrew Camisetas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="confirmar_cuenta.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo-container">
        <img src="images/logo_andrew_v2.png" alt="Logo" class="logo-img" />
        <span class="logo-text">Andrew Camisetas de Fútbol</span>
    </div>
    <ul class="nav-links">
        <li><a href="index.html">Inicio</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="#">Contacto</a></li>
    </ul>
    <div class="search-bar">
        <input type="text" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </div>
    <div class="user-actions">
        <a href="#">Hola Futbolero</a>
        <a href="carrito.php">Carrito</a>
    </div>
</header>

<!-- MENSAJE -->
<div class="mensaje-confirmacion">
    <img src="images/camiseta.png" alt="Camiseta confirmada" class="mensaje-icono" />
    <h2>¡Cuenta Confirmada!</h2>
    <p class="mensaje-principal"><?php echo $mensaje; ?></p>

    <?php if (!empty($redirigir)) : ?>
        <p class="mensaje-secundario">⚽ Serás redirigido al inicio en <strong>4 segundos</strong>...</p>
        <script>
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 4000);
        </script>
    <?php else: ?>
        <a href="index.php" class="btn-volver">🏁 Ir a la página principal</a>
    <?php endif; ?>
</div>

<!-- PIE DE PÁGINA -->
<footer class="footer">
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
    <div class="social-icons">
        <a href="https://wa.me/963345510" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.facebook.com/tu_usuario" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/tu_usuario" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html>
