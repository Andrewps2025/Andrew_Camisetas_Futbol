<?php
session_start();

// Validar si el usuario está logueado
if (!isset($_SESSION['user'])) {
    header("Location: validar_compra.php");
    exit;
}

// Obtener carrito y mensaje si está vacío
$carrito = $_SESSION['carrito'] ?? [];
$mensajeCarritoVacio = empty($carrito) ? "Tu carrito está vacío. Agrega productos para continuar." : "";

// Método de pago (aunque ahora mostraremos ambos QR)
$metodo_pago = $_SESSION['metodo_pago'] ?? 'yape';

// Productos fijos para resumen
$productos = [
    1 => ['nombre' => 'Polo Modelo 1', 'precio' => 65.00, 'imagen' => 'polo1.jpg'],
    2 => ['nombre' => 'Polo Modelo 2', 'precio' => 70.00, 'imagen' => 'polo2.jpg'],
];

$total = 0;
$mensaje = "";

// Procesar subida de comprobante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['comprobante'])) {
    $upload_dir = 'comprobantes/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $file_name = basename($_FILES['comprobante']['name']);
    $target_file = $upload_dir . time() . '_' . $file_name;

    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        $mensaje = "Formato no permitido. Solo jpg, jpeg, png, pdf.";
    } elseif ($_FILES['comprobante']['size'] > 2 * 1024 * 1024) {
        $mensaje = "Archivo muy pesado. Máximo 2MB.";
    } else {
        if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $target_file)) {
            $mensaje = "Comprobante subido correctamente. ¡Gracias por tu pago!";
            // Aquí podrías añadir lógica para guardar en BD o enviar notificación
        } else {
            $mensaje = "Error al subir el archivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Confirmar y Pagar - Andrew Camisetas</title>
    <link rel="stylesheet" href="confirmar_pago.css" />
    <!-- Fuente para iconos si usas fontawesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

<?php include 'header.php'; ?>

<div class="container">

    <h1>Confirma y paga tu compra</h1>
    <p>¡Bienvenido <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>! Aquí puedes revisar y confirmar tu compra.</p>

    <div class="checkout-wrapper">

        <!-- Columna izquierda: método de pago y subida comprobante -->
        <div class="left-column">

            <!-- Sección método de pago mostrando ambos QR lado a lado -->
            <section class="section payment-method">
                <h2>Tu medio de pago:</h2>
                <a href="#" class="change-link">Cambiar</a>

                <div class="payment-info multiple-payments">
                    <!-- Bloque Yape -->
                    <div class="payment-block">
                        <span class="payment-icon yape">Yape</span>
                        <img src="images/metodos/yape_qr.png" alt="QR Yape" class="qr-code" />
                        <p>Pago con Yape</p>
                    </div>

                    <!-- Bloque Plin -->
                    <div class="payment-block">
                        <span class="payment-icon plin">Plin</span>
                        <img src="images/metodos/plin_qr.png" alt="QR Plin" class="qr-code" />
                        <p>Pago con Plin</p>
                    </div>
                </div>
            </section>

            <!-- Mensaje éxito al subir comprobante -->
            <?php if (!empty($mensaje)) : ?>
                <p class="success-msg"><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <!-- Subida comprobante (solo si carrito NO está vacío) -->
            <?php if (empty($mensajeCarritoVacio)) : ?>
                <section class="section upload-proof">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="comprobante">Sube tu comprobante de pago (jpg, png, pdf):</label>
                        <input type="file" name="comprobante" id="comprobante" required />
                        <button type="submit">Subir comprobante</button>
                    </form>
                </section>
            <?php endif; ?>

        </div>

        <!-- Columna derecha: resumen de la compra -->
        <div class="right-column">
            <section class="section order-summary">
                <h2>Resumen de la compra</h2>

                <?php if (!empty($mensajeCarritoVacio)) : ?>
                    <p><?php echo $mensajeCarritoVacio; ?></p>
                <?php else: ?>
                    <ul class="product-list">
                        <?php foreach ($carrito as $id => $cantidad):
                            if (!isset($productos[$id])) continue;
                            $subtotal = $productos[$id]['precio'] * $cantidad;
                            $total += $subtotal;
                        ?>
                        <li class="product-item">
                            <img src="images/productos/<?php echo $productos[$id]['imagen']; ?>" alt="<?php echo htmlspecialchars($productos[$id]['nombre']); ?>" />
                            <div>
                                <p class="product-name"><?php echo htmlspecialchars($productos[$id]['nombre']); ?></p>
                                <p>Cantidad: <?php echo $cantidad; ?></p>
                                <p>Precio unitario: S/ <?php echo number_format($productos[$id]['precio'], 2); ?></p>
                                <p>Total: S/ <?php echo number_format($subtotal, 2); ?></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="order-total">
                        <p>Total:</p>
                        <p class="price">S/ <?php echo number_format($total, 2); ?></p>
                    </div>

                    <button class="pay-btn">Pagar ahora</button>
                <?php endif; ?>

            </section>
        </div>

    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
