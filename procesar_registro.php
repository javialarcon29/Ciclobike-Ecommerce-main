<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


header('Content-Type: text/html; charset=UTF-8');


// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Conectar a la base de datos (reemplaza los valores de conexión con los tuyos)
    $conexion = mysqli_connect("localhost", "root", "", "proyect");

    // Verificar la conexión
    if ($conexion === false) {
        die("Error: No se pudo conectar. " . mysqli_connect_error());
    }

    // Preparar la consulta SQL para insertar el usuario en la tabla usuarios
    $sql_insertar = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, correo, contrasena) VALUES (?, ?, ?, ?, ?)";
    if ($stmt_insertar = mysqli_prepare($conexion, $sql_insertar)) {
        mysqli_stmt_bind_param($stmt_insertar, "sssss", $nombre, $primer_apellido, $segundo_apellido, $correo, $contrasena);
        mysqli_stmt_execute($stmt_insertar);

        // Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurar el servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambiar por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'javielafrikano@gmail.com'; // Cambiar por tu correo
            $mail->Password = 'asyl sbdu lrgc dlck'; // Cambiar por tu contraseña
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Configurar el remitente y destinatario
            $mail->setFrom('javielafrikano@gmail.com', 'ciclobike');
            $mail->addAddress($correo, $nombre);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Registro exitoso';
            $mail->Body = '<h2>Hola <strong>' . $nombre . ' ' . $primer_apellido . ' ' . $segundo_apellido . '</strong></h2><br><br><h3 style="color: green;">Tu registro ha sido exitoso. Ahora puedes <a href="https://85cb-66-81-183-166.ngrok-free.app/proyecto-dia-19-abril-main/">Iniciar sesion</a>.</h3><br><br>Gracias por registrarte, nuestro equipo está encantado de que formes parte de nuestra comunidad.';

            // Enviar el correo electrónico
            $mail->send();

            // Mostrar mensaje de registro exitoso como alerta en JavaScript
            echo "<script>alert('Registro exitoso. Redirigiendo al inicio de sesión...'); window.location='login.php';</script>";
            exit; // Asegurarse de que el script se detenga después de la redirección
        } catch (Exception $e) {
            echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error al preparar la consulta de inserción: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Si se intenta acceder al archivo directamente sin enviar el formulario, redirigir o mostrar un mensaje de error
    echo "Acceso no autorizado";
}
?>
