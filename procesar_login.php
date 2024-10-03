<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Conectar a la base de datos (reemplaza los valores de conexión con los tuyos)
    $conexion = mysqli_connect("localhost", "root", "", "proyect");

    // Verificar la conexión
    if ($conexion === false) {
        die("Error: No se pudo conectar. " . mysqli_connect_error());
    }

    // Consulta SQL para buscar el usuario en la base de datos
    $sql = "SELECT id, rol FROM usuarios WHERE correo = ? AND contrasena = ?";
    
    // Preparar la declaración
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "ss", $correo, $contrasena);

        // Ejecutar la declaración
        if (mysqli_stmt_execute($stmt)) {
            // Obtener el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verificar si se encontró el usuario
            if ($row = mysqli_fetch_assoc($result)) {
                // Usuario encontrado, iniciar sesión y redirigir según el rol
                session_start();
                $_SESSION["usuario_id"] = $row["id"]; // Ejemplo: Guardar el ID del usuario en la sesión

                // Redirigir según el rol
                if ($row["rol"] == "admin") {
                    header("Location: apartado_cliente.php");
                } else {
                    header("Location: indexlogeado.php");
                }
                exit(); // Asegurarse de que el script se detenga después de la redirección
            } else {
                echo '<script>';
                echo 'alert("Contraseña incorrecta. Inténtalo de nuevo.");';
                echo 'window.location.href = "login.php";'; // Redirigir a login.php
                echo '</script>';
            }
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Si se intenta acceder al archivo directamente sin enviar el formulario, redirigir o mostrar un mensaje de error
    echo "Acceso no autorizado";
}
?>




