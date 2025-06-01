<?php
session_start();

// Simulación de dirección (puedes obtenerla desde base de datos o sesión)
$direccion = "Juan Zapata - B-19, 19, Lima-imperial-cañete, San Vicente De Cañete, Lima";

// Simulación productos comprados (en un caso real esto viene de la sesión o base de datos)
$productos = [
    ['nombre' => 'Polo Modelo 1', 'precio' => 65.00, 'cantidad' => 2, 'imagen' => 'images/polo1.jpg'],
    ['nombre' => 'Polo Modelo 2', 'precio' => 70.00, 'cantidad' => 1, 'imagen' => 'images/polo2.jpg'],
    ['nombre' => 'Polo Modelo 3', 'precio' => 80.00, 'cantidad' => 3, 'imagen' => 'images/polo3.jpg'],
];

// Cálculo total productos
$total_productos = 0;
foreach ($productos as $p) {
    $total_productos += $p['precio'] * $p['cantidad'];
}

// Simulación descuentos y costos envío
$descuentos = 15.00;
$entregas = 10.00;
$total_final = $total_productos - $descuentos + $entregas;
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
        <div class="direccion">
            <i>📍</i>
            Dirección - <?= htmlspecialchars($direccion) ?>
            <a href="#" class="cambiar-direccion">Cambiar</a>
        </div>

        <h3>Vendido por Andrew Camisetas</h3>

        <div class="opcion-entrega">
            <label>
                <input type="radio" name="entrega" checked />
                Retiro en un punto <span class="gratis">Gratis</span>
                <small>Desde el 26 de mayo. En Falabella Cañete (2.8km)</small>
            </label>
        </div>

        <div class="opcion-entrega">
            <label>
                <input type="radio" name="entrega" />
                Envío a domicilio
                <small>Entrega estimada: 27 de mayo</small>
                <span class="costo-envio">S/ 9.90</span>
            </label>
        </div>

        <!-- Lista productos comprados -->
        <div class="productos-comprados">
            <h3>Productos en compra</h3>
            <?php foreach ($productos as $prod): ?>
                <div class="producto-lista-item">
                    <img src="<?= htmlspecialchars($prod['imagen']) ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="producto-lista-img" />
                    <div class="producto-lista-info">
                        <div class="nombre"><?= htmlspecialchars($prod['nombre']) ?></div>
                        <div class="detalle">Cantidad: <?= $prod['cantidad'] ?> | Precio unitario: S/ <?= number_format($prod['precio'], 2) ?></div>
                    </div>
                    <div class="producto-lista-precio">
                        S/ <?= number_format($prod['precio'] * $prod['cantidad'], 2) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="resumen">
        <h2>Resumen de la compra</h2>

        <div class="resumen-item">
            <span>Productos (<?= count($productos) ?>)</span>
            <span>S/ <?= number_format($total_productos, 2) ?></span>
        </div>
        <div class="resumen-item descuento">
            <span>Descuentos (2)</span>
            <span>- S/ <?= number_format($descuentos, 2) ?></span>
        </div>
        <div class="resumen-item">
            <span>Entregas (2)</span>
            <span>S/ <?= number_format($entregas, 2) ?></span>
        </div>

        <div class="resumen-item resumen-total">
            <span>Total:</span>
            <span>S/ <?= number_format($total_final, 2) ?></span>
        </div>

        <a href="pago.php" class="btn-pagar">Ir a pagar</a>
    </div>
</div>

</body>
</html>
