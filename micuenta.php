<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos (reemplaza los valores de conexión con los tuyos)
$conexion = mysqli_connect("localhost", "root", "", "proyect");

// Verificar la conexión
if ($conexion === false) {
    die("Error: No se pudo conectar. " . mysqli_connect_error());
}

$usuario_id = $_SESSION["usuario_id"];

// Obtener los datos del usuario de la base de datos
$sql = "SELECT id, nombre, primer_apellido, segundo_apellido, correo FROM usuarios WHERE id = ?";
if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($result);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php require 'head_user_logeado.php'; ?>
<br><br><br><br><br>
<div class="container">
    <h2>Modificar datos de mi cuenta</h2>
    <br>
    <form action="actualizar_cuenta.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>
        <label for="primer_apellido">Primer Apellido:</label>
        <input type="text" name="primer_apellido" value="<?php echo $usuario['primer_apellido']; ?>"><br>
        <label for="segundo_apellido">Segundo Apellido:</label>
        <input type="text" name="segundo_apellido" value="<?php echo $usuario['segundo_apellido']; ?>"><br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $usuario['correo']; ?>"><br>
        <input type="submit" value="Guardar cambios">
    </form>
</div>

<?php require 'footer.php'; ?> <!-- Footer al final -->

</body>
</html>
