<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $telefono = $_POST["phone"];
    $mensaje = $_POST["message"];

    // Configuración del correo
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'inversionest.toluca@gmail.com'; // Reemplaza con tu correo
        $mail->Password = 'Arquitecto27'; // Puede ser una contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom($email, $nombre);
        $mail->addAddress('inversionest.toluca@gmail.com'); // Reemplázalo con tu correo de destino

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "<h3>Nombre: $nombre</h3>
                        <p>Email: $email</p>
                        <p>Teléfono: $telefono</p>
                        <p>Mensaje: $mensaje</p>";

        $mail->send();
        echo "success"; // Respuesta en AJAX
    } catch (Exception $e) {
        echo "error: {$mail->ErrorInfo}";
    }
}
?>
