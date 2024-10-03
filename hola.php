<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Verifica si se recibieron datos POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lee el contenido JSON recibido
    $json_data = file_get_contents("php://input");
    var_dump($json_data);
    var_dump($_POST);
    // Decodifica el JSON a un array asociativo
    $data = json_decode($json_data, true);
    
    // Accede a los datos y realiza las operaciones necesarias
    $payment_id = $data['id'];
    $event_type = $data['payer']['email_address'];
    $user_email = $data['payer']['email_address']; // Suponiendo que el correo del usuario está aquí
    $username = $data['payer']['name']['given_name'];
    $username2 = $data['payer']['name']['surname'];
    $precio = $data['purchase_units'][0]['amount']['value'];
    $fullname = $data['purchase_units'][0]['shipping']['name']['full_name'];


         $direccion = $data['purchase_units'][0]['shipping']['address']['address_line_1'];
         $provincia = $data['purchase_units'][0]['shipping']['address']['admin_area_1'];
         $ciudad = $data['purchase_units'][0]['shipping']['address']['admin_area_2'];
         $codigo_postal = $data['purchase_units'][0]['shipping']['address']['postal_code'];


    $create_time = $data['create_time'];
    $update_time = $data['update_time'];
    $link_href = $data['links'][0]['href'];

    // Conexión a la base de datos (modifica según tus credenciales)
    $servername = "localhost";
    $usernamer = "root";
    $password = "";
    $dbname = "proyect";
    
    // Crea la conexión
    $conn = new mysqli($servername, $usernamer, $password, $dbname);
    
    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Prepara la consulta SQL para insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO paypal_orders (payment_id, event_type, user_email, username, username2, precio, create_time, update_time, link_href, direccion, provincia, codigo_postal, ciudad) 
            VALUES ('$payment_id', '$event_type', '$user_email', '$username', '$username2', '$precio', '$create_time', '$update_time', '$link_href','$direccion','$provincia','$codigo_postal','$ciudad')";
    
    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, envía una respuesta de éxito
        http_response_code(200);
        echo "Datos recibidos y almacenados exitosamente.";


        header('Content-Type: text/html; charset=UTF-8');

        // Envía un correo electrónico al cliente usando PHPMailer
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
            
            // Destinatario
            $mail->setFrom('javielafrikano@gmail.com', 'CicloBike');
            $mail->addAddress($user_email, $username . ' ' . $username2);
            
           // Contenido del correo
$mail->isHTML(true);
$mail->CharSet = 'UTF-8'; // Establece la codificación de caracteres como UTF-8

$mail->Subject = "Confirmación de pago en Ciclobike";
$mail->Body = "
<!DOCTYPE html>
<html>
<head>
    <style>

    .final {
        line-height: inherit;
        box-sizing: border-box;
        font-size: 10px;
        text-align: center; /* Centrar el texto */
        margin-top: 20px; /* Ajustar margen superior según sea necesario */
    }

     img {
            width: 500px;
            display: block;
            margin: 0 auto;
            height: 130px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .details {
            margin-top: 20px;
            border-top: 2px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>¡Gracias por tu compra en CicloBike!</h1>
        <p>Estimado $username $username2,</p>
        <p>Tu compra ha sido registrada con éxito. Aquí están los detalles:</p>
        <div class='details'>
            <p><strong>ID de Pago:</strong> $payment_id</p>
            <p><strong>Precio:</strong> $precio €</p>
            <p><strong>Dirección de Envío:</strong><br>
            $direccion<br>
            $provincia, $ciudad, $codigo_postal</p>
        </div>
        <p>¡Esperamos que disfrutes tu compra! Si tienes alguna pregunta, no dudes en ponerte en contacto con nuestro equipo de soporte.</p>
        <p>¡Que tengas un gran día!</p>
        <img src='https://i.ebayimg.com/images/g/VEsAAOSwTm9c-pFy/s-l1200.jpg' alt='Background Image'>
       
    </div>
    <div class='final'>
    <p>Para cualquier consulta o duda, contáctanos por correo electrónico a info@ciclobike.com. Nota:
     Por posibles errores tipográficos, los precios indicados en este correo pueden variar en comparación con los precios de nuestra página web. 
     Siempre prevalecerán los precios que figuran en nuestro sitio web. Ciclobike S.L., con sede en Av. de la Bicicleta, 123, 29630 Málaga, está registrada en 
     el Registro Mercantil de Málaga, Tomo 12345, Folio 678, Inscripción 1, con CIF B-12345678.</p>

    </div>
</body>
</html>
";

// Envía el correo electrónico
$mail->send();
            
            echo 'El correo electrónico ha sido enviado.';
        } catch (Exception $e) {
            echo "El correo electrónico no pudo ser enviado. Error: {$mail->ErrorInfo}";
        }
    } else {
        // Si ocurrió un error al insertar en la base de datos, envía un mensaje de error
        http_response_code(500);
        echo "Error al almacenar los datos: " . $conn->error;
    }
    
    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    // Si no es una solicitud POST, envía un error
    http_response_code(405);
    echo "Método no permitido.";
}
?>
