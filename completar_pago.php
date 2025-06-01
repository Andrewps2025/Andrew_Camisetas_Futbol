<?php
session_start();
include 'conexion.php'; // Archivo con la conexión a la BD

// Verificamos que haya productos en el carrito y el usuario esté logueado o tenga email en sesión
if (!isset($_SESSION['email_usuario'])) {
    header("Location: validar_compra.php");
    exit;
}

// Obtener los productos del carrito para mostrar y calcular total
$user_email = $_SESSION['email_usuario'];

// Consulta ejemplo para obtener productos del carrito (ajusta según tu BD)
$sql = "SELECT p.id, p.nombre, p.precio, p.imagen, c.cantidad, (p.precio*c.cantidad) AS total
        FROM carrito c 
        INNER JOIN productos p ON p.id = c.producto_id
        WHERE c.usuario_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Procesar el formulario de selección de entrega
$entrega_seleccionada = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['entrega'])) {
        $entrega_seleccionada = $_POST['entrega'];
        $_SESSION['entrega'] = $entrega_seleccionada;

        // Aquí puedes guardar la elección en la BD si quieres

        // Redirigir a la página de pago
        header("Location: pago.php");
        exit;
    } else {
        $error = "Por favor, selecciona un método de entrega.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Completar Compra - Andrew Camisetas</title>
    <link rel="stylesheet" href="completar_compra.css" />
</head>
<body>

<div class="container">

    <div class="entrega">
        <h3>Selecciona tu método de entrega</h3>

        <?php if ($error): ?>
            <p style="color: #e54867; font-weight: 700; margin-bottom: 15px;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="">

            <label class="opcion-entrega">
                <input type="radio" name="entrega" value="retiro" <?= $entrega_seleccionada == "retiro" ? "checked" : "" ?> />
                Retiro en un punto <span class="gratis">Gratis</span>
                <small>Desde el 26 de mayo. En Falabella Cañete (2.8km)</small>
            </label>

            <label class="opcion-entrega">
                <input type="radio" name="entrega" value="domicilio" <?= $entrega_seleccionada == "domicilio" ? "checked" : "" ?> />
                Envío a domicilio
                <small>Entrega estimada: 27 de mayo</small>
                <span class="costo-envio">S/ 9.90</span>
            </label>

            <button type="submit" class="btn-pagar">Ir a pagar</button>
        </form>

        <div class="productos-comprados">
            <h3>Productos en tu compra</h3>

            <?php if ($result->num_rows > 0): ?>
                <?php while($prod = $result->fetch_assoc()): ?>
                    <div class="producto-lista-item">
                        <img src="images/Polo_Modelo<?= $prod['id'] ?>/<?= $prod['imagen'] ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="producto-lista-img" />
                        <div class="producto-lista-info">
                            <div class="nombre"><?= htmlspecialchars($prod['nombre']) ?></div>
                            <div class="detalle">Cantidad: <?= $prod['cantidad'] ?> - Precio unitario: S/ <?= number_format($prod['precio'], 2) ?></div>
                        </div>
                        <div class="producto-lista-precio">S/ <?= number_format($prod['total'], 2) ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No tienes productos en el carrito.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="resumen">
        <h2>Resumen de la compra</h2>
        <?php
        // Calcula totales para mostrar en resumen
        $totalProductos = 0;
        $cantidadProductos = 0;
        $result->data_seek(0); // Reinicia el puntero del resultado para recorrerlo de nuevo

        while ($prod = $result->fetch_assoc()) {
            $totalProductos += $prod['total'];
            $cantidadProductos += $prod['cantidad'];
        }

        $costoEnvio = ($entrega_seleccionada == "domicilio") ? 9.90 : 0;
        $descuento = 0; // Puedes agregar lógica para descuentos
        $totalFinal = $totalProductos + $costoEnvio - $descuento;
        ?>

        <div class="resumen-item">
            <span>Productos (<?= $cantidadProductos ?>)</span>
            <span>S/ <?= number_format($totalProductos, 2) ?></span>
        </div>
        <div class="resumen-item descuento">
            <span>Descuentos (0)</span>
            <span>- S/ <?= number_format($descuento, 2) ?></span>
        </div>
        <div class="resumen-item">
            <span>Entregas (<?= $entrega_seleccionada == "domicilio" ? 1 : 0 ?>)</span>
            <span>S/ <?= number_format($costoEnvio, 2) ?></span>
        </div>

        <div class="resumen-item resumen-total">
            <span>Total:</span>
            <span>S/ <?= number_format($totalFinal, 2) ?></span>
        </div>

    </div>

</div>

</body>
</html>
