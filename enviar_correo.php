<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    // Instanciar PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambiar por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'javielafrikano@gmail.com'; // Cambiar por tu correo
        $mail->Password = 'asyl sbdu lrgc dlck'; // Cambiar por tu contraseña
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;



// Configuración del correo
$mail->setFrom($email, $nombre); // Establecer el remitente como el usuario que envía el mensaje
$mail->addAddress('javielafrikano@gmail.com'); // Cambiar por el correo de destino
$mail->Subject = 'Nuevo Mensaje de ' . $nombre;
$mail->isHTML(true); // Establecer el formato del correo como HTML
$mail->Body = <<<EOHTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #B3FAE5;
            color: black;
            text-align: center;
            padding: 20px;
        }

        section {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
<header>
    <h1>Nueva consulta de : <strong>  $nombre </strong></h1>
</header>
<br>
<section>
    <table>
        <tr>
            <th>Nombre:</th>
            <td>$nombre</td>
        </tr>
        <tr>
            <th>Correo del usuario:</th>
            <td>$email</td>
        </tr>
        <tr>
            <th>Mensaje:</th>
            <td>$mensaje</td>
        </tr>
    </table>

    <!-- Image in the section -->
    <img src="https://i.ebayimg.com/images/g/VEsAAOSwTm9c-pFy/s-l1200.jpg" alt="Background Image" style="width: 500px; display: block; margin: 0 auto;">
</section>

<br><br><br><br><br><br>

<footer>
    <p>&copy; 2024 CicloBike</p>
</footer>
</body>
</html>
EOHTML;



        // Enviar el correo
        $mail->send();

        // Redirigir a una página de éxito si el correo se envió correctamente
        header("Location: contacto.php");
        exit();
    } catch (Exception $e) {
        // Redirigir a una página de error si hubo un problema al enviar el correo
        header("Location: error_envio.php");
        exit();
    }
} else {
    // Redirigir a una página de error si se accede directamente a este archivo sin enviar el formulario
    header("Location: error_acceso.php");
    exit();
}
?>
