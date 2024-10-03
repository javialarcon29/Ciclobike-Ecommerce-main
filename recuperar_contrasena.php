<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

header('Content-Type: text/html; charset=UTF-8');

// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico del formulario
    $correo = $_POST["correo"];
 
    // Aquí debes implementar la lógica para generar un token único y guardarlo en tu base de datos junto con la dirección de correo electrónico del usuario
    // Por simplicidad, aquí se genera un token aleatorio
    $token = bin2hex(random_bytes(16)); // Genera un token aleatorio de 32 caracteres hexadecimales
 
    // Conectarse a la base de datos y guardar el token
    // Aquí deberás usar tus propias credenciales y lógica de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyect";
 
    $conn = new mysqli($servername, $username, $password, $dbname);
 
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
 
    // Preparar la consulta SQL para insertar el token en la base de datos
    $sql = "INSERT INTO tokens_recuperacion (correo, token) VALUES ('$correo', '$token')";
 
    if ($conn->query($sql) === TRUE) {
        // Token guardado correctamente en la base de datos
        // Ahora envía el token por correo electrónico al usuario
 
        // Configurar PHPMailer
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
            $mail->setFrom('javielafrikano@gmail.com', 'Ciclo Bike'); // Cambiar por tu dirección de correo y nombre
            $mail->addAddress($correo); // Dirección de correo del destinatario
 
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacion de Contrasena';
            $mail->Body = <<<EOHTML
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Recuperación de Contraseña</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        margin: 0;
                        padding: 0;
                        line-height: 1.6;
                    }
                    header {
                        background-color: #FCC118;
                        color: black;
                        text-align: center;
                        padding: 20px;
                    }
                    footer {
                        background-color: #333;
                        color: white;
                        text-align: center;
                        padding: 10px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    p {
                        margin-bottom: 10px;
                    }
                    a {
                        color: #007bff;
                        text-decoration: none;
                    }
                    img {
                        display: block;
                        margin: 0 auto;
                        max-width: 100%;
                    }
                </style>
            </head>
            <body>
                <header>
                    <h1>Recuperacion de Contrasena</h1>
                </header>
                <div class="container">
                    <p>Hola,</p>
                    <p>Hemos recibido una solicitud para restablecer la contrasena de tu cuenta.</p>
                    <p>Tu token de recuperación es: $token</p>
                    <p>Por favor, sigue las instrucciones en el siguiente enlace para restablecer tu contrasena:</p>
                    <p><a href="https://a43e-81-45-136-248.ngrok-free.app/proyecto-dia-19-abril-main/restablecer_contrasena.php?token=$token">Restablecer Contraseña</a></p>
                    <p>Si no has solicitado esto, puedes ignorar este mensaje.</p>
                </div>
                <!-- Image in the section -->
                <img src="https://i.ebayimg.com/images/g/VEsAAOSwTm9c-pFy/s-l1200.jpg" alt="Background Image" style="max-width: 300px; display: block; margin: 0 auto;">
                <footer>
                    <p>&copy; 2024 CicloBike</p>
                </footer>
            </body>
            </html>
            EOHTML;
 
            // Enviar el correo electrónico
            $mail->send();
 
            // Redirigir al usuario a una página de éxito
            header("Location: login_mensaje_recu.php");
            exit();
        } catch (Exception $e) {
            echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error al guardar el token en la base de datos: " . $conn->error;
    }
 
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 250px auto; /* Aumenté el margen superior e inferior a 80px */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Alineación central */
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            text-align: center;
        }
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
           
            text-decoration: none;
           
        }
    </style>
</head>
<body>
 
<?php require_once 'head_cliente_inicio.php'; ?>
 
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="correo" required>
           
            <input type="submit" value="Recuperar contraseña">
        </form>
        <br>
        <a href="login.php">Volver al Inicio de Sesión</a>
    </div>
</body>
</html>