<?php
session_start();

// Variable para mostrar mensaje de error al validar email
$error = "";

// Validar email al enviar formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST["email"]);

    // Validar formato email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, ingresa un correo electrónico válido.";
    } else {
        // Guardar email en sesión para usar luego en login
        $_SESSION['email_usuario'] = $email;
        // Nota: no redirigimos porque usamos modal para login
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Validar Compra - Andrew Camisetas</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="validar_compra.css" />
</head>
<body>

<!-- Contenedor formulario email -->
<div class="form-container">
    <h2>Ingresa tu correo electrónico</h2>

    <!-- Mostrar error si existe -->
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Formulario para email -->
    <form id="emailForm" method="POST" action="">
        <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required />
        <button type="submit">Continuar</button>
    </form>

    <p>Tu correo será utilizado para continuar con la compra y futuras notificaciones.</p>
</div>

<!-- Overlay para oscurecer fondo al mostrar modal -->
<div id="modalOverlay"></div>

<!-- Modal login para ingresar contraseña -->
<div id="passwordModal">
    <h3>Inicia sesión para comprar</h3>
    <p>Correo electrónico:</p>
    <input type="text" id="displayEmail" readonly />

    <!-- Formulario contraseña -->
    <form id="passwordForm">
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required />
        <button type="submit">Ingresar</button>
    </form>

    <button id="closeModal">Cerrar</button>
</div>

<script>
// Mostrar modal contraseña cuando se envía email sin recargar
document.getElementById('emailForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita que se envíe el formulario tradicionalmente

    const emailInput = document.getElementById('email').value.trim();

    if(emailInput === "") {
        alert("Por favor, ingresa un correo válido.");
        return;
    }

    // Mostrar email en modal para que usuario vea el correo que ingresó
    document.getElementById('displayEmail').value = emailInput;

    // Mostrar modal y overlay
    document.getElementById('modalOverlay').classList.add('active');
    document.getElementById('passwordModal').classList.add('active');
});

// Cerrar modal al hacer clic en botón "Cerrar" o en el overlay
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modalOverlay').classList.remove('active');
    document.getElementById('passwordModal').classList.remove('active');
});
document.getElementById('modalOverlay').addEventListener('click', () => {
    document.getElementById('modalOverlay').classList.remove('active');
    document.getElementById('passwordModal').classList.remove('active');
});

// Enviar contraseña con AJAX para validar login sin recargar página
document.getElementById('passwordForm').addEventListener('submit', function(e){
    e.preventDefault();

    const password = document.getElementById('password').value.trim();
    const email = document.getElementById('displayEmail').value;

    if(password === "") {
        alert("Por favor, ingresa tu contraseña.");
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    // Enviar datos a login_compra.php
    fetch('login_compra.php', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Redirigir a confirmar_pago.php si login exitoso
            window.location.href = 'confirmar_pago.php';
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        alert("Error en servidor.");
        console.error(err);
    });
});
</script>

</body>
</html>
