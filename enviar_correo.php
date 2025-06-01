<?php
require 'vendor/autoload.php';  // Asegúrate que esta ruta está correcta según tu proyecto

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';           
    $mail->SMTPAuth = true;                    
    $mail->Username = 'tu-correo@gmail.com';  // Cambia aquí tu correo Gmail
    $mail->Password = 'tu-contraseña-app';    // Cambia aquí tu contraseña de app Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    $mail->Port = 587;                        

    $mail->setFrom('tu-correo@gmail.com', 'Andrew Camisetas');
    $mail->addAddress('destino@ejemplo.com', 'Usuario');  // Cambia al correo destino para prueba

    $mail->isHTML(true);
    $mail->Subject = 'Prueba de PHPMailer';
    $mail->Body    = '<b>Hola!</b> Este es un correo enviado con PHPMailer desde localhost.';

    $mail->send();
    echo 'Correo enviado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar correo: {$mail->ErrorInfo}";
}
