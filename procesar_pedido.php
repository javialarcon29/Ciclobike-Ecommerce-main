<?php
// Verificar si se ha enviado el formulario de finalizar compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar_compra'])) {
    // Obtener los datos del formulario
    $nombre_cliente = $_POST['nombre']; // Obtener el nombre del cliente
    $direccion_entrega = $_POST['direccion']; // Obtener la dirección de entrega
    $metodo_pago = $_POST['metodo_pago']; // Obtener el método de pago
    $email_cliente = $_POST['email']; // Obtener el correo electrónico del cliente

    $total_carrito = $_POST['total_carrito']; // Obtener el total del carrito

    // Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
    $dsn = 'mysql:host=localhost;dbname=proyect';
    $usuario = 'root';
    $contraseña = '';

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta SQL para insertar el pedido en la tabla de pedidos
        $sql = "INSERT INTO pedidos (nombre, direccion, email, metodo_pago, total, fecha_pedido) 
                VALUES (:nombre, :direccion, :email, :metodo_pago, :total, NOW())";
        $consulta = $conexion->prepare($sql);

        // Enlazar los parámetros de la consulta
        $consulta->bindParam(':nombre', $nombre_cliente);
        $consulta->bindParam(':direccion', $direccion_entrega);
        $consulta->bindParam(':email', $email_cliente); // Enlazar el campo "Email"
        $consulta->bindParam(':metodo_pago', $metodo_pago);
        $consulta->bindParam(':total', $total_carrito);

        // Ejecutar la consulta
        $consulta->execute();

        // Mostrar un mensaje de éxito
        echo '<p>Pedido procesado correctamente. Redirigiendo a la pasarela de pago...</p>';
        header('Location: pasarela.php');
        exit(); // Asegúrate de usar exit() después de la redirección para detener la ejecución del script
    } catch (PDOException $e) {
        // Manejar cualquier error de la base de datos
        echo '<p>Error al procesar el pedido: ' . $e->getMessage() . '</p>';
    }
} else {
    // Redireccionar si se intenta acceder a este script directamente sin enviar el formulario
    header('Location: pagina_de_error.php');
    exit();
}
?>
