<?php
require_once 'conexion.php'; // Asegúrate de tener este archivo

// Actualizar estado del pago si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['estado'])) {
    $id = intval($_POST['id']);
    $estado = $_POST['estado'];

    $validos = ['pendiente', 'verificado', 'rechazado'];
    if (in_array($estado, $validos)) {
        $stmt = $conn->prepare("UPDATE pagos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Obtener todos los pagos
$resultado = $conn->query("SELECT * FROM pagos ORDER BY fecha_pago DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #003366;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f3f3f3;
        }
        form {
            margin: 0;
        }
        select, button {
            padding: 5px;
        }
        .comprobante {
            max-width: 100px;
        }
    </style>
</head>
<body>

<h2>Administrador de Pagos</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Correo</th>
            <th>Método</th>
            <th>Comprobante</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Cambiar Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= htmlspecialchars($fila['email']) ?></td>
                <td><?= $fila['metodo_pago'] ?></td>
                <td>
                    <a href="comprobantes/<?= $fila['archivo_comprobante'] ?>" target="_blank">Ver archivo</a>
                </td>
                <td><?= $fila['fecha_pago'] ?></td>
                <td><?= $fila['estado'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                        <select name="estado">
                            <option value="pendiente" <?= $fila['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="verificado" <?= $fila['estado'] == 'verificado' ? 'selected' : '' ?>>Verificado</option>
                            <option value="rechazado" <?= $fila['estado'] == 'rechazado' ? 'selected' : '' ?>>Rechazado</option>
                        </select>
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
