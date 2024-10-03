<?php
// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el token y la nueva contraseña del formulario
    $token = $_POST["token"];
    $nueva_contrasena = $_POST["nueva_contrasena"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];

    // Verificar si la contraseña y la confirmación coinciden
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyect";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el token es válido y obtener el correo asociado al token
    $sql = "SELECT correo FROM tokens_recuperacion WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Token válido, actualizar la contraseña del usuario
        $stmt->bind_result($correo);
        $stmt->fetch();

        // Hashear la nueva contraseña antes de almacenarla en la base de datos
        $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la tabla de usuarios
        $sql_update = "UPDATE usuarios SET contrasena = ? WHERE correo = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", $hashed_password, $correo);
        $stmt_update->execute();

        // Eliminar el token de recuperación de la tabla
        $sql_delete = "DELETE FROM tokens_recuperacion WHERE token = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("s", $token);
        $stmt_delete->execute();

        // Redirigir al usuario a una página de éxito
        header("Location: login.php");
        exit();
    } else {
        // Token no válido, mostrar mensaje de error
        echo "El token no es válido.";
    }

    // Cerrar las conexiones y liberar recursos
    $stmt->close();
    $stmt_update->close();
    $stmt_delete->close();
    $conn->close();
}
?>
 
 <?php require_once 'head_cliente_inicio.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
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
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style></style>
</head>
<body>

<div class="container">
    <h2>Restablecer Contraseña</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
        <input type="submit" value="Restablecer contraseña">
    </form>
</div>

</body>
</html>
