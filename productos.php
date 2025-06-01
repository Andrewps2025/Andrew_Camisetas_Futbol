<?php
// 1. Iniciar sesión para verificar si hay un usuario logueado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "andrew_camisetas_de_futbol";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// 3. Consulta para obtener productos del 1 al 14 ordenados por ID
$sql = "SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE id BETWEEN 1 AND 14 ORDER BY id ASC";
$result = $conn->query($sql);

// 4. Obtener nombre de usuario si está logueado
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Andrew Camisetas</title>

    <!-- CSS -->
    <link rel="stylesheet" href="producto.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles_encabezado_footer.css">

    <!-- Font Awesome para íconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- HEADER FIJO -->
<header class="navbar">
    <!-- Logo y texto -->
    <a href="index.php" class="logo-container">
        <img src="images/logo_andrew_v2.png" alt="Logo" class="logo-img">
        <span class="logo-text">Andrew Camisetas de Fútbol</span>
    </a>

    <!-- Menú de navegación -->
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php" class="active">Productos</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>

    <!-- Buscador -->
    <div class="search-bar">
        <form action="buscar.php" method="GET">
            <input type="text" name="q" placeholder="Buscar...">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- Usuario y carrito -->
    <div class="user-actions">
        <!-- Menú desplegable de cuenta -->
        <div class="mi-cuenta-dropdown" onclick="toggleDropdown()">
            <div class="dropdown-toggle">
                <?= $nombreUsuario ? "Hola, <strong>$nombreUsuario</strong>" : "Mi Cuenta" ?> <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-menu" id="menuCuenta" style="display: none;">
                <?php if ($nombreUsuario): ?>
                    <a href="mi_cuenta.php">Mi cuenta</a>
                    <a href="mis_compras.php">Mis compras</a>
                    <a href="cerrar_sesion.php">Cerrar sesión</a>
                <?php else: ?>
                    <a href="login.php">Iniciar sesión</a>
                    <a href="registro.php">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Carrito -->
        <a href="ver_carrito.php" class="carrito-link">Carrito</a>
    </div>
</header>

<!-- CONTENIDO PRINCIPAL -->
<main class="main-productos" style="margin-top: 100px;">
    <h1 class="titulo-productos">Productos</h1>

    <section class="productos-lista">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ruta_imagen = 'images/Polo_Modelo' . $row['id'] . '/' . $row['imagen'];
                echo '<div class="producto-card">';
                echo '<a href="producto_detalle.php?id=' . $row['id'] . '" class="link-producto">';
                echo '<img src="' . htmlspecialchars($ruta_imagen) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                echo '<h2>' . htmlspecialchars($row['nombre']) . '</h2>';
                echo '</a>';
                echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
                echo '<p><strong>S/ ' . number_format($row['precio'], 2) . '</strong></p>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay productos disponibles.</p>';
        }
        ?>
    </section>
</main>

<!-- FOOTER -->
<footer class="footer">
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
    <div class="social-icons">
        <a href="https://wa.me/963345510" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.facebook.com/tu_usuario" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/tu_usuario" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

<!-- SCRIPT para mostrar/ocultar el menú desplegable -->
<script>
function toggleDropdown() {
    const menu = document.getElementById("menuCuenta");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
</script>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
