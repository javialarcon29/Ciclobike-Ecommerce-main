<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pedido_id"]) && isset($_POST["nuevo_estado"])) {
    $pedido_id = $_POST["pedido_id"];
    $nuevo_estado = $_POST["nuevo_estado"];

    // Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
    $dsn = 'mysql:host=localhost;dbname=proyect';
    $usuario = 'root';
    $contraseña = '';

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para actualizar el estado del pedido
        $sql_update = "UPDATE pedidos SET estado = :nuevo_estado WHERE id_pedido = :pedido_id";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bindParam(':nuevo_estado', $nuevo_estado);
        $stmt_update->bindParam(':pedido_id', $pedido_id);
        $stmt_update->execute();

        // Consulta SQL para obtener los datos del pedido actualizado
        $sql_select_pedido = "SELECT * FROM pedidos WHERE id_pedido = :pedido_id";
        $stmt_select = $conexion->prepare($sql_select_pedido);
        $stmt_select->bindParam(':pedido_id', $pedido_id);
        $stmt_select->execute();
        $pedido_actualizado = $stmt_select->fetch(PDO::FETCH_ASSOC);

        // Enviar correo electrónico al usuario con el nuevo estado del pedido utilizando PHPMailer
        $mail = new PHPMailer(true);

        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambiar por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'javielafrikano@gmail.com'; // Cambiar por tu correo
        $mail->Password = 'asyl sbdu lrgc dlck'; // Cambiar por tu contraseña
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;


        // Consulta SQL para obtener el correo del remitente
        $sql_select_remitente = "SELECT email FROM pedidos WHERE id_pedido = :pedido_id";
        $stmt_remitente = $conexion->prepare($sql_select_remitente);
        $stmt_remitente->bindParam(':pedido_id', $pedido_id);
        $stmt_remitente->execute();
        $remitente = $stmt_remitente->fetch(PDO::FETCH_ASSOC);

        
        // Configurar el correo
        $mail->setFrom($remitente['email'], 'NUEVO ESTADO DE SU PEDIDO '); // Remitente del correo
        $mail->addAddress($remitente['email']); // Correo del destinatario
        $mail->Subject = 'Estado pedido - '. $nuevo_estado;
        $mail->isHTML(true);
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
                    background-color: #B3FAE5; /* Estilo en línea para el color de fondo */
                    color: black;
                    text-align: center;
                    padding: 20px;
                }
        
                section {
                    margin: 20px;
                }
        
                footer {
                    background-color: #333; /* Estilo en línea para el color de fondo */
                    color: white;
                    text-align: center;
                    padding: 10px;
                }
            </style>
        </head>
        <body>
        <header>
            <h1>Actualizacion de estado del pedido</h1>
        </header>
        <br>
        <section>
            <p>Estimado cliente, el estado de su pedido con referencia <strong> $pedido_id </strong> ha sido actualizado. </strong>,</p>
            <p>Nuevo estado: <strong>$nuevo_estado</strong></p>
        </section>
        <br><br><br><br><br><br>
        <section>
            <!-- Image in the section -->
            <img src="https://i.ebayimg.com/images/g/VEsAAOSwTm9c-pFy/s-l1200.jpg" alt="Background Image" style="width: 500px; display: block; margin: 0 auto;">
        </section>
        <footer>
            <p>&copy; 2024 CicloBike</p>
        </footer>
        </body>
        </html>
        EOHTML;
        
        







        
        // Enviar el correo electrónico
        $mail->send();

        // Redirigir de vuelta a la página principal o a otra página si es necesario
        header('Location: admin.php');
        exit();
    } catch (PDOException $e) {
        // Manejar cualquier error de la base de datos
        echo '<p>Error al actualizar el estado del pedido: ' . $e->getMessage() . '</p>';
    } catch (Exception $e) {
        // Manejar cualquier error de PHPMailer
        echo '<p>Error al enviar el correo electrónico: ' . $e->getMessage() . '</p>';
    }
} else {
    // Manejar la situación en la que no se enviaron los datos del formulario correctamente
    echo "No se recibieron datos válidos para actualizar el estado del pedido.";
}
?>
