<?php
// ✅ Iniciar sesión para guardar datos como el nombre del usuario
session_start();

// ✅ Cargar PHPMailer con autoload de Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// ✅ Verificar que el formulario se haya enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ✅ Obtener y limpiar los datos del formulario
    $email = trim($_POST['email'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $doc_tipo = trim($_POST['doc_tipo'] ?? '');
    $numero_documento = trim($_POST['numero_documento'] ?? '');
    $celular = trim($_POST['celular'] ?? '');
    $password_raw = $_POST['password'] ?? '';

    // ✅ Validar que todos los campos estén llenos
    if (!$email || !$nombre || !$apellidos || !$doc_tipo || !$numero_documento || !$celular || !$password_raw) {
        exit("Por favor completa todos los campos obligatorios.");
    }

    // ✅ Validar formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Correo electrónico no válido.");
    }

    // ✅ Validar longitud mínima de la contraseña
    if (strlen($password_raw) < 8) {
        exit("La contraseña debe tener al menos 8 caracteres.");
    }

    // ✅ Encriptar la contraseña de forma segura
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // ✅ Conectar a la base de datos (ajusta estos datos según tu configuración)
    $conn = new mysqli("localhost", "root", "", "andrew_camisetas_de_futbol");
    if ($conn->connect_error) {
        exit("Error de conexión a la base de datos.");
    }

    // ✅ Verificar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT confirmado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($confirmado);
    $stmt->fetch();
    $stmt->close();

    // ✅ Evaluar el estado del correo consultado
    if ($confirmado === null) {
        // El correo no existe aún: se continúa con el registro
    } else if ($confirmado == 0) {
        // Ya se registró, pero no se confirmó: redirige a confirmación
        header("Location: confirmar_cuenta.php?email=" . urlencode($email));
        exit;
    } else {
        // Ya está registrado y confirmado
        exit("El correo electrónico ya está registrado y confirmado. Por favor inicia sesión.");
    }

    // ✅ Generar un código aleatorio de 6 dígitos para confirmar cuenta
    $codigo_confirmacion = rand(100000, 999999);

    // ✅ Insertar nuevo usuario con estado "no confirmado"
    $stmt = $conn->prepare("INSERT INTO usuarios 
        (email, nombre, apellidos, doc_tipo, numero_documento, celular, password, codigo_confirmacion, confirmado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssssss", $email, $nombre, $apellidos, $doc_tipo, $numero_documento, $celular, $password, $codigo_confirmacion);

    if (!$stmt->execute()) {
        exit("Error al registrar usuario.");
    }

    $stmt->close();
    $conn->close();

    // ✅ GUARDAR el nombre del usuario en la sesión para mostrarlo luego (como en index.php)
    $_SESSION['nombre_usuario'] = $nombre;

    // ✅ Configurar y enviar correo con PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // Cambia a 2 para ver mensajes de depuración
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '2201010250@undc.edu.pe'; // Tu correo Gmail
        $mail->Password = 'abispkfkouakokag';       // Contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('2201010250@undc.edu.pe', 'Andrew Camisetas');
        $mail->addAddress($email, $nombre); // Destinatario

        $mail->isHTML(true);
        $mail->Subject = 'Confirma tu cuenta - Andrew Camisetas';
        $mail->Body = "
            Hola <b>$nombre</b>,<br><br>
            Tu código de confirmación es: <b>$codigo_confirmacion</b><br><br>
            Ingresa este código para activar tu cuenta.<br><br>
            Gracias por registrarte.
        ";

        $mail->send();

        // ✅ Redirigir al usuario para que confirme su cuenta
        header("Location: confirmar_cuenta.php?email=" . urlencode($email));
        exit;

    } catch (Exception $e) {
        exit("Error al enviar correo: " . $mail->ErrorInfo);
    }

} else {
    // ❌ Si no se envió por POST, se bloquea el acceso
    exit("Método inválido.");
}
