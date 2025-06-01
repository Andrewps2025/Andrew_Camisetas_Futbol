<?php
// confirmar_cuenta.php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET['email'] ?? '';
    if (!$email) {
        exit("No se ha proporcionado correo electrónico.");
    }
} else {
    exit("Método inválido.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Confirmar Cuenta - Andrew Camisetas</title>

    <!-- Vinculo al CSS principal corregido -->
    <link rel="stylesheet" href="confirmar_cuenta.css" />

    <!-- Iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

    <!-- =================================== -->
    <!-- ENCABEZADO PRINCIPAL (NAVBAR) -->
    <!-- =================================== -->
    <header class="navbar">
        <div class="logo-container">
            <!-- Asegúrate de tener logo.png en la MISMA carpeta -->
            <img src="images/logo_andrew_v2.png" alt="Logo Andrew Camisetas de Futbol" class="logo-img" />
            <span class="logo-text">Andrew Camisetas de Fútbol</span>
        </div>

        <ul class="nav-links">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Productos</a></li>
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

    <!-- =================================== -->
    <!-- CONTENIDO PRINCIPAL -->
    <!-- =================================== -->
    <main class="main-container confirmar-box">
        <h1>Confirma tu cuenta</h1>
        <p>Correo registrado: <b><?php echo htmlspecialchars($email); ?></b></p>

        <form method="POST" action="validar_confirmacion.php">
            <!-- Campo oculto para reenviar el correo -->
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />

            <label for="codigo">Código de confirmación:</label>
            <input
                type="text"
                name="codigo"
                id="codigo"
                maxlength="6"
                pattern="\d{6}"
                title="Ingresa un código de 6 dígitos"
                required
            />
            <button type="submit">Confirmar cuenta</button>
        </form>
    </main>

    <!-- =================================== -->
    <!-- PIE DE PÁGINA -->
    <!-- =================================== -->
    <footer class="footer">
        <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
        <div class="social-icons">
            <a href="https://wa.me/963345510" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.facebook.com/tu_usuario" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/tu_usuario" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

</body>
</html>
