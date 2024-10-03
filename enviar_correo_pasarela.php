<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Verificar si se ha enviado el formulario correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pedido'])) {
    $nombre_apellido = $_POST['nombre_apellido'];
    $correo_electronico = $_POST['correo_electronico'];
    $codigo_postal = $_POST['codigo_postal'];

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
        $mail->setFrom('javielafrikano@gmail.com', 'Ciclo Bike'); // Cambiar por tu nombre y correo
        $mail->addAddress($owner_email); // Dirección de correo del propietario obtenida del formulario
        $mail->Subject = 'CONFIRMACION DE PAGO';
        $mail->isHTML(true); // Establecer el formato del correo como HTML
        $mail->Body =  <<<EOHTML
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
            <h1>Su pago a sido realizado con exito</strong></h1>
        </header>
        <br>
        <section>
        <p><strong>Estimado cliente $usuario , <strong></p>
        <br>
        <br>
           <p>¡Enhorabuena! 🎉 Tu pago ha sido procesado con éxito en nuestra página CicloBike .  
           <p>Queremos agradecerte por confiar en nosotros para tu compra. Estamos emocionados de acompañarte en tu experiencia ciclista y aseguramos brindarte los mejores productos y servicios.

           <p>Actualmente, estamos procesando tu pedido con dedicación y cuidado para garantizar que todo esté en perfectas condiciones antes de enviarlo. Nuestro equipo está trabajando arduamente para preparar tu envío y asegurarnos de que llegue a ti en el menor tiempo posible.<p>
           
           En CicloBike, valoramos tu satisfacción y nos esforzamos por ofrecerte una experiencia de compra excepcional. Queremos que disfrutes al máximo de tus actividades ciclistas con equipos y accesorios de calidad.
           
           Recuerda que estamos aquí para cualquier consulta o asistencia que necesites. No dudes en contactarnos si tienes alguna pregunta sobre tu pedido o cualquier otro tema relacionado con nuestros productos y servicios.
           <br>
         <p>  ¡Gracias nuevamente por elegir CicloBike! Esperamos que tu experiencia con nosotros sea extraordinaria y que encuentres todo lo que necesitas para tus aventuras en bicicleta.</p>
        
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

        // Redirigir a la página de éxito
        header('Location: pago_exitoso.php');
        exit();
    } catch (Exception $e) {
        // Redirigir a la página de error de acceso con un mensaje de error
    header('Location: error_acceso.php?error=datos_faltantes');
    exit();
}
} else {
    // Redirigir a la página de error de acceso
    header('Location: error_acceso.php');
    exit();
}



?>
