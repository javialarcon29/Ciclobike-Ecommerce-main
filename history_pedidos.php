<?
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario de la sesión
$usuario_id = $_SESSION["usuario_id"];

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

// Verificar la conexión
if ($conexion === false) {
    die("Error: No se pudo conectar. " . mysqli_connect_error());
}

// Consulta SQL para obtener los pedidos del usuario
$sql = "SELECT * FROM pedidos WHERE id_pedido = ?";
if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        // Mostrar los pedidos del usuario
        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID Pedido: " . $row["id"] . "<br>";
            echo "Producto: " . $row["producto"] . "<br>";
            echo "Cantidad: " . $row["cantidad"] . "<br>";
            echo "Fecha Pedido: " . $row["fecha_pedido"] . "<br>";
            echo "<br>";
        }
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>