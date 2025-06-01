<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir saludo dinámico con nombre del usuario si está logueado
$saludo = isset($_SESSION['nombre_usuario']) 
    ? "Hola, <strong>" . htmlspecialchars($_SESSION['nombre_usuario']) . "</strong>" 
    : "Mi Cuenta";
?>

<!-- HEADER FIJO -->
<header class="navbar" style="
  position: fixed; 
  top: 0; 
  width: 100%; 
  z-index: 1000; 
  background-color: #003366; 
  display: flex; 
  align-items: center; 
  padding: 10px 40px;
  font-family: Arial, sans-serif;
">

  <!-- Logo y texto -->
  <a href="index.php" style="display: flex; align-items: center; text-decoration: none; flex-shrink: 0; margin-left: -20px;">
    <img src="images/logo_andrew_v2.png" alt="Logo" style="height: 60px; border-radius: 50%; margin-right: 15px;">
    <span style="color: white; font-size: 20px; font-weight: bold; letter-spacing: 0.05em;">
      Andrew Camisetas de Fútbol
    </span>
  </a>

  <!-- Navegación -->
  <nav style="margin-left: 150px;">
    <ul style="
      list-style: none; 
      display: flex; 
      gap: 40px;
      margin: 0; 
      padding: 0;
    ">
      <li><a href="index.php" style="color: white; text-decoration: none; font-weight: 600; font-size: 16px;">Inicio</a></li>
      <li><a href="productos.php" style="color: white; text-decoration: none; font-weight: 600; font-size: 16px;">Productos</a></li>
      <li><a href="#" style="color: white; text-decoration: none; font-weight: 600; font-size: 16px;">Contacto</a></li>
    </ul>
  </nav>

  <!-- Espacio flexible para empujar el resto a la derecha -->
  <div style="flex-grow: 1;"></div>

  <!-- Buscador -->
  <form action="buscar.php" method="GET" style="display: flex; align-items: center; margin-right: 25px;">
    <input type="text" name="q" placeholder="Buscar..." style="padding: 6px 10px; border-radius: 4px; border: none; font-size: 14px;" />
    <button type="submit" style="background: red; border: none; padding: 7px 15px; margin-left: 6px; color: white; cursor: pointer; border-radius: 4px; font-weight: 600;">
      Buscar
    </button>
  </form>

  <!-- Usuario y carrito -->
  <div style="display: flex; align-items: center; gap: 20px;">

    <!-- Dropdown de cuenta (tipo Falabella) -->
    <div class="mi-cuenta-dropdown" onclick="toggleDropdown()" style="cursor: pointer; color: white; font-weight: 600; font-size: 16px; position: relative;">
      <div class="dropdown-toggle" style="display: flex; align-items: center; gap: 5px;">
        <?= $saludo ?> <i class="fas fa-chevron-down"></i>
      </div>
      <div class="dropdown-menu" id="menuCuenta" style="
        position: absolute;
        top: 30px;
        right: 0;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        display: none;
        flex-direction: column;
        min-width: 160px;
        z-index: 10000;
      ">
        <a href="mi_cuenta.php" style="padding: 10px 16px; color: #222; text-decoration: none; border-bottom: 1px solid #ddd;">Mi cuenta</a>
        <a href="mis_compras.php" style="padding: 10px 16px; color: #222; text-decoration: none; border-bottom: 1px solid #ddd;">Mis compras</a>
        <a href="cerrar_sesion.php" style="padding: 10px 16px; color: #222; text-decoration: none;">Cerrar sesión</a>
      </div>
    </div>

    <!-- Enlace al carrito -->
    <a href="ver_carrito.php" style="color: white; font-weight: 600; text-decoration: none; font-size: 16px;">Carrito</a>
  </div>
</header>

<!-- SCRIPT PARA DROPDOWN -->
<script>
  function toggleDropdown() {
    const menu = document.getElementById('menuCuenta');
    menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
  }

  // Cerrar el dropdown si se hace clic fuera de él
  document.addEventListener('click', function (e) {
    const dropdown = document.querySelector('.mi-cuenta-dropdown');
    const menu = document.getElementById('menuCuenta');

    if (!dropdown.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
</script>
