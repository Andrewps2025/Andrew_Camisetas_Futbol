<?php
// Iniciar sesión para poder acceder a la variable $_SESSION
session_start();

// Verificar si hay un nombre de usuario guardado en sesión
// Si existe, lo almacenamos en $nombreUsuario para mostrarlo en el saludo
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro - Andrew Camisetas de Fútbol</title>

  <!-- CSS personalizado -->
  <link rel="stylesheet" href="registro.css" />
  <!-- Íconos FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>

  <!-- HEADER fijo -->
  <header class="navbar">
    <!-- Logo y nombre de tienda -->
    <a href="index.php" class="logo-container">
      <img src="images/logo_andrew_v2.png" alt="Logo Andrew Camisetas de Futbol" class="logo-img" />
      <span class="logo-text">Andrew Camisetas de Fútbol</span>
    </a>

    <!-- Menú de navegación -->
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>
    </nav>

    <!-- Barra de búsqueda -->
    <div class="search-bar">
      <input type="text" placeholder="Buscar..." />
      <button>Buscar</button>
    </div>

    <!-- Sección usuario/carrito -->
    <div class="user-actions">
      <!-- Enlace dinámico con nombre del usuario si está logueado -->
      <a href="registro.php" class="mi-cuenta-link" title="Mi Cuenta">
        <?php if ($nombreUsuario): ?>
          Hola, <strong><?= $nombreUsuario ?></strong>
        <?php else: ?>
          Hola, <strong>Futbolero</strong>
        <?php endif; ?>
      </a>
      <a href="ver_carrito.php" class="carrito-link">Carrito</a>
    </div>
  </header>

  <!-- CONTENEDOR PRINCIPAL -->
  <main class="registro-container">

    <!-- FORMULARIO DE REGISTRO -->
    <section class="registro-form">
      <h1>Inicia sesión o regístrate para comprar</h1>

      <form action="procesar_registro.php" method="POST">
        <!-- Correo electrónico -->
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="Tu correo" required />

        <!-- Nombre -->
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa un nombre" required />

        <!-- Apellidos -->
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Ingresa apellidos" required />

        <!-- Tipo de documento -->
        <label for="doc_tipo">Tipo de documento</label>
        <select id="doc_tipo" name="doc_tipo" required>
          <option value="dni">DNI</option>
          <option value="ce">Carné de Extranjería</option>
          <option value="pasaporte">Pasaporte</option>
        </select>

        <!-- Número de documento -->
        <label for="doc_num">Número de documento</label>
        <input type="text" id="doc_num" name="numero_documento" placeholder="Ingresa tu documento" required />

        <!-- Celular -->
        <label for="celular">Celular</label>
        <input type="tel" id="celular" name="celular" placeholder="+51 Ingresa un celular" required />

        <!-- Contraseña -->
        <label for="password">Contraseña</label>
        <div class="password-wrapper">
          <input type="password" id="password" name="password" placeholder="Ingresa una contraseña" required />
          <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
            <i class="fas fa-eye"></i>
          </button>
        </div>

        <!-- Requisitos de contraseña -->
        <ul class="password-requirements">
          <li>Mín. 8 caracteres</li>
          <li>1 número</li>
          <li>1 mayúscula</li>
          <li>1 minúscula</li>
          <li>Sin espacios</li>
          <li>Sin caracteres especiales como '¡¿¨ºª`çñÑ'</li>
        </ul>

        <!-- Aceptar términos y condiciones -->
        <label class="checkbox-label">
          <input type="checkbox" name="acepta_terminos" required />
          Acepto los <a href="#">términos y condiciones</a>.
        </label>

        <!-- Aceptar política de privacidad -->
        <label class="checkbox-label">
          <input type="checkbox" name="acepta_privacidad" required />
          Acepto la <a href="#">política de privacidad</a>.
        </label>

        <!-- Botón de envío -->
        <button type="submit" class="btn-primary">Registrarse</button>
      </form>
    </section>

    <!-- BENEFICIOS DEL SITIO -->
    <aside class="registro-beneficios">
      <h2>Beneficios Andrew Camisetas</h2>
      <ul class="beneficios-list">
        <li><i class="fas fa-shipping-fast"></i> Envíos rápidos y seguros a todo el país.</li>
        <li><i class="fas fa-headset"></i> Atención personalizada y asesoría experta en camisetas.</li>
        <li><i class="fas fa-star"></i> Calidad garantizada en productos oficiales.</li>
        <li><i class="fas fa-futbol"></i> Variedad de diseños para fanáticos del fútbol.</li>
      </ul>
      <hr />
      <h2>Ventajas exclusivas para ti</h2>
      <ul class="beneficios-list">
        <li><i class="fas fa-gift"></i> Promociones y descuentos para clientes registrados.</li>
        <li><i class="fas fa-coins"></i> Programa de puntos para canjes y beneficios.</li>
      </ul>
    </aside>
  </main>

  <!-- PIE DE PÁGINA -->
  <footer class="footer">
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
    <div class="social-icons">
      <a href="https://wa.me/963345510" target="_blank"><i class="fab fa-whatsapp"></i></a>
      <a href="https://www.facebook.com/tu_usuario" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/tu_usuario" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
  </footer>

  <!-- Script para mostrar/ocultar contraseña -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const togglePassword = document.querySelector('.toggle-password');
      const passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('fa-eye');
        togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
      });
    });
  </script>

</body>
</html>
