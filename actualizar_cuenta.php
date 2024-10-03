<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza los valores de conexión con los tuyos)
    $conexion = mysqli_connect("localhost", "root", "", "proyect");

    // Verificar la conexión
    if ($conexion === false) {
        die("Error: No se pudo conectar. " . mysqli_connect_error());
    }

    // Obtener los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $correo = $_POST["correo"];

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET nombre=?, primer_apellido=?, segundo_apellido=?, correo=? WHERE id=?";
    
    // Preparar la declaración
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $primer_apellido, $segundo_apellido, $correo, $id);

        // Ejecutar la declaración
        if (mysqli_stmt_execute($stmt)) {
            // Redireccionar a micuenta.php
            header("Location: micuenta.php");
            exit; // Asegurarse de que el script se detenga después de la redirección
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
        }
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Si se intenta acceder al archivo directamente sin enviar el formulario, redirigir o mostrar un mensaje de error
    echo "Acceso no autorizado";
}
?>
