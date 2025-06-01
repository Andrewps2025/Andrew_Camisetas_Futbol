<?php
session_start();

header('Content-Type: application/json');

// Recibir datos por POST
$producto_id = isset($_POST['producto_id']) ? intval($_POST['producto_id']) : 0;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
$talla = $_POST['talla'] ?? '';
$nombre_jugador = $_POST['nombre_jugador'] ?? '';
$numero_jugador = $_POST['numero_jugador'] ?? '';

// Validar datos mínimos
if ($producto_id <= 0 || $cantidad < 1 || empty($talla) || empty($nombre_jugador) || empty($numero_jugador)) {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos para agregar al carrito.'
    ]);
    exit;
}

// Inicializar carrito en sesión si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// El carrito guardará productos con detalles (para evitar sobreescritura de tallas o nombres diferentes)
$productoKey = $producto_id . '_' . $talla . '_' . $nombre_jugador . '_' . $numero_jugador;

// Si ya existe ese producto con esa configuración, se suma la cantidad, sino se crea nuevo
if (isset($_SESSION['carrito'][$productoKey])) {
    $_SESSION['carrito'][$productoKey]['cantidad'] += $cantidad;
} else {
    $_SESSION['carrito'][$productoKey] = [
        'producto_id' => $producto_id,
        'cantidad' => $cantidad,
        'talla' => $talla,
        'nombre_jugador' => $nombre_jugador,
        'numero_jugador' => $numero_jugador,
    ];
}

echo json_encode([
    'success' => true,
    'message' => 'Producto agregado correctamente.'
]);
