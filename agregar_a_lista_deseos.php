<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar la lista de deseos si no existe
if (!isset($_SESSION['lista_deseos'])) {
    $_SESSION['lista_deseos'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Conexión a la base de datos
    $host = 'localhost';
    $dbname = 'proyect';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener los detalles del producto
        $stmt = $pdo->prepare("SELECT * FROM articulos WHERE id = :id");
        $stmt->bindParam(':id', $producto_id);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            // Comprobar si el producto ya está en la lista de deseos
            if (isset($_SESSION['lista_deseos'][$producto_id])) {
                // Eliminar el producto de la lista de deseos
                unset($_SESSION['lista_deseos'][$producto_id]);
                $status = 'removed';
            } else {
                // Agregar el producto a la lista de deseos
                $_SESSION['lista_deseos'][$producto_id] = $producto;
                $status = 'added';
            }
        } else {
            $status = 'error';
        }

    } catch (PDOException $e) {
        $status = 'error';
    }

    echo json_encode(['status' => $status]);
}
?>
