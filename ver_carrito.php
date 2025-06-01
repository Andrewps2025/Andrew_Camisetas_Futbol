<?php
// ✅ Iniciar sesión para poder validar al usuario logueado
session_start();

// ✅ Si no hay sesión activa, redirigir a la página de registro/login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: registro.php");
    exit();
}

// ✅ Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// ✅ Obtener el ID del usuario desde sesión (ya no usamos valor por defecto)
$usuario_id = $_SESSION['usuario_id'];

// ✅ Consulta para obtener los productos del carrito de este usuario
$sql = "SELECT c.id, c.producto_id, c.cantidad, c.talla, c.nombre_jugador, c.numero_jugador,
               p.nombre AS nombre_producto, p.precio, p.imagen
        FROM carrito c
        INNER JOIN productos p ON c.producto_id = p.id
        WHERE c.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

// ✅ Procesamos los resultados y calculamos el total
$carrito_items = [];
$total = 0;

while ($row = $result->fetch_assoc()) {
    $subtotal_item = $row['precio'] * $row['cantidad'];
    $total += $subtotal_item;
    $row['subtotal'] = $subtotal_item;
    $carrito_items[] = $row;
}

$stmt->close();
$conn->close();

// ✅ Obtenemos el nombre del usuario logueado
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : 'Futbolero';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi Carrito de Compras - Andrew Camisetas</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="ver_carrito.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
</head>

<body>

<!-- ✅ Header con menú dinámico -->
<?php include 'header.php'; ?>

<!-- ✅ CONTENIDO DEL CARRITO -->
<main class="carrito-main">
  <h1>Mi Carrito de Compras</h1>

  <?php if (empty($carrito_items)) : ?>
    <div class="mensaje-vacio">Tu carrito está vacío.</div>
  <?php else: ?>
    <div class="carrito-contenedor">

      <!-- 🛍️ PRODUCTOS DEL CARRITO -->
      <section class="carrito-productos">
        <h2>Carro (<?= count($carrito_items) ?> productos)</h2>
        <div class="productos-lista">
          <?php foreach ($carrito_items as $item) : ?>
            <article class="producto-item">
              <input type="checkbox" checked>
              <img src="<?= htmlspecialchars($item['imagen']) ?>" alt="<?= htmlspecialchars($item['nombre_producto']) ?>" />
              <div class="producto-info">
                <h3><?= htmlspecialchars($item['nombre_producto']) ?></h3>
                <p class="marca">Marca XYZ</p>
                <p>Talla: <?= htmlspecialchars($item['talla']) ?></p>
                <p>Nombre jugador: <?= htmlspecialchars($item['nombre_jugador']) ?></p>
                <p>Número jugador: <?= htmlspecialchars($item['numero_jugador']) ?></p>
              </div>
              <div class="producto-precio">
                <p>S/ <?= number_format($item['precio'], 2) ?></p>
                <div class="cantidad-control">
                  <button>-</button>
                  <input type="number" value="<?= $item['cantidad'] ?>" min="1" max="10" />
                  <button>+</button>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 💳 RESUMEN DEL PEDIDO -->
      <aside class="carrito-resumen">
        <h2>Resumen de la orden</h2>
        <p><strong>Productos (<?= count($carrito_items) ?>)</strong></p>
        <p>S/ <?= number_format($total, 2) ?></p>
        <p><strong>Total:</strong></p>
        <p class="total-importe">S/ <?= number_format($total, 2) ?></p>
        <a href="checkout.php" class="btn-comprar">Continuar compra</a>

        <div class="info-pago">
          <img src="images/yape.png" alt="Pago con Yape" />
          <p>¡Ahora puedes pagar tus compras con Yape!</p>
        </div>
      </aside>
    </div>
  <?php endif; ?>
</main>

<!-- ✅ Footer -->
<footer class="footer">
  <div class="container-footer">
    <p>&copy; 2025 Andrew Camisetas de Fútbol. Todos los derechos reservados.</p>
    <div class="social-icons">
      <a href="#"><i class="fab fa-whatsapp"></i></a>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </div>
</footer>

</body>
</html>
