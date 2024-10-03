<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza los valores con los de tu base de datos)
    $host = 'localhost';
    $dbname = 'proyect';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener los datos del formulario
        $producto_id = $_POST['producto_id'];
        $usuario_id = $_POST['usuario_id']; // Se espera que este sea el ID de usuario
        $reseña = $_POST['reseña'];

        // Consultar la tabla de usuarios para obtener el nombre de usuario asociado al ID
        $stmt_usuario = $pdo->prepare("SELECT nombre FROM usuarios WHERE id = :usuario_id");
        $stmt_usuario->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt_usuario->execute();
        $resultado_usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

        if ($resultado_usuario) {
            $nombre_usuario = $resultado_usuario['nombre'];

            // Insertar la reseña en la base de datos
            $sql = "INSERT INTO reseñas (producto_id, usuario, reseña) VALUES (:producto_id, :nombre_usuario, :reseña)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':reseña', $reseña, PDO::PARAM_STR);
            $stmt->execute();

            // Redirigir de vuelta a la ficha técnica del producto
            header("Location: ficha_tecnico_carretera.php?id=$producto_id");
            exit();
        } else {
            echo "Usuario no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
}
?>
