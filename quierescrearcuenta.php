<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

header('Content-Type: text/html; charset=UTF-8');

if(isset($_POST['confirmar_compra'])){
    // Recoger los datos del formulario
   // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $primer_apellido = $_POST['primer_apellido'];
        $segundo_apellido = $_POST['segundo_apellido'];
        $direccion = $_POST['direccion'];
        $codigo_postal = $_POST['codigo_postal'];
        $municipio = $_POST['municipio'];
        $correo = $_POST['email'];

    // Calcular el total del pedido
    $total_pedido = 0;
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total_pedido += $subtotal;
        }
    }
    $mensaje = "<h2>Gracias por tu compra, $nombre $primer_apellido</h2>";
    $mensaje .= "<hr>";
    $mensaje .= "<h3>Detalle del pedido:</h3>";
    $mensaje .= "<ul>";
    foreach ($_SESSION['carrito'] as $item) {
        $mensaje .= "<li><strong>Producto:</strong> " . $item['nombre'] . "<br>";
        $mensaje .= "<strong>Cantidad:</strong> " . $item['cantidad'] . "<br>";
        $mensaje .= "<strong>Precio unitario:</strong> " . number_format($item['precio'], 2, ',', '.') . "€<br>"; // Formatear precio con coma y punto como separadores
        $mensaje .= "<strong>Subtotal:</strong> " . number_format(($item['precio'] * $item['cantidad']), 2, ',', '.') . "€</li>"; // Formatear subtotal con coma y punto como separadores
    }
    $mensaje .= "</ul>";
    $mensaje .= "<hr>";
    $mensaje .= "<p><strong>Total del pedido:</strong> " . number_format($total_pedido, 2, ',', '.') . "€</p>"; // Formatear total con coma y punto como separadores
    $mensaje .= "<h3>Dirección de envío:</h3>";
    $mensaje .= "<p><strong>Dirección:</strong> $direccion</p>";
    $mensaje .= "<p><strong>Código Postal:</strong> $codigo_postal</p>";
    $mensaje .= "<p><strong>Municipio:</strong> $municipio</p>";
    $mensaje .= "<p><strong>Gracias por confiar en nosotros , cualquier duda e incidencia no dude en ponerse en contacto con nuestro equipo, estaremos encantado de ayudarle</strong></p>"; // Mensaje en negrita

    // Agregar la imagen al final del mensaje
    $mensaje .= "<img src='https://i.ebayimg.com/images/g/VEsAAOSwTm9c-pFy/s-l1200.jpg' alt='Background Image' style='width: 500px; display: block; margin: 0 auto; height: 130px;'>";
    
    // Ahora $mensaje contiene toda la información más la imagen al final.
    
    // Crear una instancia de PHPMailer
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

        // Configurar remitente y destinatario
        $mail->setFrom('javielafrikano@gmail.com', 'CicloBike');
        $mail->addAddress($correo); // Usar el correo del usuario como destinatario

        // Configurar el contenido del correo
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; // Establecer la codificación de caracteres a UTF-8
        $mail->Subject = 'Confirmación de tu compra en CicloBike';
        $mail->Body = $mensaje;

        // Enviar el correo
        $mail->send();
       // Mostrar Sweet Alert después de enviar el correo
echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js'></script>";
echo "<script>";
echo "Swal.fire({
    title: '¡Su compra a sido realizada con éxito!',
    html: 'Se ha enviado la confirmación de tu compra a tu correo electrónico. <p>¡Muchas gracias por confiar en CicloBike!</p>',
    icon: 'success',
    onClose: function() {
        window.location.href = 'carrito.php';
    }
});";
echo "</script>";

    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    // Si el formulario no ha sido enviado, redireccionar al carrito de compras
    header("Location: carrito.php");
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <!-- Enlace al archivo CSS de Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
    <!-- Enlace al archivo CSS para el formulario de creación de cuenta -->
    <link rel="stylesheet" href="css/quierescrearcuenta.css">
    <style>
        .ventajas-btn {
            pointer-events: none; /* Deshabilita la funcionalidad de clic */
        }
    </style>
</head>
<body>
    <form id="crearCuentaForm" action="procesar_registro.php" method="post">
        <label style="text-align: center;"><h2>Registrarse:</h2></label>
        <br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>
        <!-- Campos ocultos para pasar los datos previamente ingresados -->
        <input type="hidden" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" id="primer_apellido" name="primer_apellido" value="<?php echo $primer_apellido; ?>">
        <input type="hidden" id="segundo_apellido" name="segundo_apellido" value="<?php echo $segundo_apellido; ?>">
        <input type="hidden" id="correo" name="correo" value="<?php echo $correo; ?>">
        <input type="hidden" id="direccion" name="direccion" value="<?php echo $direccion; ?>">
        <input type="hidden" id="codigo_postal" name="codigo_postal" value="<?php echo $codigo_postal; ?>">
        <input type="hidden" id="municipio" name="municipio" value="<?php echo $municipio; ?>">
        <button type="submit">Crear Cuenta</button>
        <br><br>
        <a href="index.php">No, gracias</a>
        <!-- Botón "Ventajas" con menú desplegable -->
        <div class="ventajas">
            <button class="ventajas-btn">Ventajas</button>
            <div class="ventajas-content">
                <p>Si se registra, podrá disfrutar de ventajas exclusivas y promociones nuevas cada fin de semana , <strong>Y lo mas importante , podra ver su historial de pedidos</strong> y muchas mas cosas</p>
            </div>
        </div>
    </form>
</body>
</html>


