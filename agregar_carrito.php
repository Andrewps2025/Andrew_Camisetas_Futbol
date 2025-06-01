<?php
// ✅ Iniciar sesión para acceder a variables del usuario como $_SESSION['usuario_id']
session_start();

// ✅ Evita mostrar errores en la salida JSON
ini_set('display_errors', 0);
error_reporting(0);

// ✅ Limpia cualquier salida previa para evitar errores de encabezado o JSON corrupto
if (ob_get_length()) ob_end_clean();

// ✅ Establecer encabezado para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// ✅ Paso 1: Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // ❌ Si no está logueado, devolver mensaje de error y ruta para redireccionar
    echo json_encode([
        "success" => false,
        "redirect" => "registro.php", // Ruta sugerida para redirigir
        "message" => "Debes iniciar sesión o registrarte para agregar productos al carrito."
    ]);
    exit;
}

// ✅ Paso 2: Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");

// ❌ Verificar errores de conexión
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Error de conexión a la base de datos: " . $conn->connect_error
    ]);
    exit;
}

// ✅ Paso 3: Obtener el ID del usuario desde la sesión activa
$usuario_id = $_SESSION['usuario_id'];

// ✅ Paso 4: Validar que los datos necesarios han sido enviados mediante POST
if (isset($_POST['producto_id'], $_POST['cantidad'])) {
    // Limpiar y convertir los datos recibidos
    $producto_id = intval($_POST['producto_id']);
    $cantidad = max(1, intval($_POST['cantidad'])); // Asegura que la cantidad mínima sea 1
    $talla = isset($_POST['talla']) ? trim($_POST['talla']) : '';
    $nombre_jugador = isset($_POST['nombre_jugador']) ? trim($_POST['nombre_jugador']) : '';
    $numero_jugador = isset($_POST['numero_jugador']) ? trim($_POST['numero_jugador']) : '';

    // ✅ Paso 5: Verificar si ya existe un registro con las mismas características
    $sqlCheck = "SELECT id, cantidad FROM carrito 
                 WHERE producto_id = ? AND talla = ? AND nombre_jugador = ? AND numero_jugador = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param("isssi", $producto_id, $talla, $nombre_jugador, $numero_jugador, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ Paso 6: Si el producto ya está en el carrito con las mismas opciones, se actualiza la cantidad
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nueva_cantidad = $row['cantidad'] + $cantidad;

        $stmtUpdate = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
        $stmtUpdate->bind_param("ii", $nueva_cantidad, $row['id']);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // ✅ Paso 7: Si no existe aún, insertar el nuevo producto al carrito
        $stmtInsert = $conn->prepare("INSERT INTO carrito (producto_id, cantidad, talla, nombre_jugador, numero_jugador, usuario_id) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmtInsert->bind_param("iisssi", $producto_id, $cantidad, $talla, $nombre_jugador, $numero_jugador, $usuario_id);
        $stmtInsert->execute();
        $stmtInsert->close();
    }

    // ✅ Cierre de conexiones
    $stmt->close();
    $conn->close();

    // ✅ Respuesta positiva
    echo json_encode([
        "success" => true,
        "message" => "Producto agregado correctamente."
    ]);
    exit;

} else {
    // ❌ Faltan datos esenciales para agregar al carrito
    $conn->close();
    echo json_encode([
        "success" => false,
        "message" => "Faltan datos esenciales para agregar el producto."
    ]);
    exit;
}
?>
