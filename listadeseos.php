<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar la lista de deseos si no existe
if (!isset($_SESSION['lista_deseos'])) {
    $_SESSION['lista_deseos'] = array();
}

// Verificar si se ha recibido el ID del producto para eliminarlo de la lista de deseos
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eliminar'])) {
    $producto_id = $_GET['eliminar'];
    // Verificar si el producto existe en la lista de deseos
    if (isset($_SESSION['lista_deseos'][$producto_id])) {
        // Si el producto existe, eliminarlo de la lista de deseos
        unset($_SESSION['lista_deseos'][$producto_id]);
    }
    // Redirigir de vuelta a esta página después de eliminar el producto
    header("Location: listadeseos.php");
    exit; // Asegura que no se ejecute más código después de la redirección
}

// Verificar si se ha recibido el ID del producto por la URL para agregarlo a la lista de deseos
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $producto_id = $_GET['id'];
    
    // Verificar si el producto ya está en la lista de deseos antes de agregarlo
    if (!isset($_SESSION['lista_deseos'][$producto_id])) {
        // Realizar la consulta para obtener la información del producto seleccionado
        $host = 'localhost';
        $dbname = 'proyect';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener los detalles del producto seleccionado
            $stmt = $pdo->prepare("SELECT * FROM articulos WHERE id = :id");
            $stmt->bindParam(':id', $producto_id);
            $stmt->execute();
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Agregar el producto a la lista de deseos
            $_SESSION['lista_deseos'][$producto_id] = $producto;
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Deseos</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 50px auto;
    max-width: 1200px;
}

.producto-en-lista {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: calc(25% - 30px);
    text-align: center;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.producto-en-lista:hover {
    transform: translateY(-5px);
}

.producto-en-lista h2 {
    margin: 0;
    font-size: 1.2em;
    color: #333;
}

.precio {
    font-weight: bold;
    color: #009688;
    margin-top: 10px;
}

.add-to-cart-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
    transition: background-color 0.3s ease;
}

.add-to-cart-btn:hover {
    background-color: #45a049;
}

.eliminar img {
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-top: -70px;
}

.item-img {
    max-width: 100%;
    height: auto;
    max-height: 185px;
}

.title-container {
    text-align: center;
    margin: 20px auto;
    padding: 10px;
    background-color: #333;
    border-radius: 8px;
    color: #fff;
    max-width: 800px;
}

.title-container h1 {
    margin: 0;
    font-size: 2em;
}

/* Media query para hacer responsive */
@media (max-width: 768px) {
    .producto-en-lista {
        width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .producto-en-lista {
        width: calc(100% - 20px);
    }
}
.add-to-cart-btn {
    /* Otros estilos */
    margin-bottom: 10px; /* Aumenta el margen inferior del botón */
}

.eliminar img {
    /* Otros estilos */
    margin-top: -50px; /* Ajusta el margen superior del icono de eliminar */
}

    </style>
</head>
<body>
    <?php require 'head_cliente_inicio.php'; ?>

    <div class="title-container">
    <h1>LISTA DE DESEOS</h1>
</div>
    <div class="container">
        <?php
        // Mostrar los productos en la lista de deseos
        if (!empty($_SESSION['lista_deseos'])) {
            foreach ($_SESSION['lista_deseos'] as $producto_id => $producto) {
                $ficha_tecnica_url = '';
                switch ($producto['categoria']) {
                    case 'ciudad':
                        $ficha_tecnica_url = 'ficha_tecnico_ciudad.php?id=' . $producto['id'];
                        break;
                    case 'carretera':
                        $ficha_tecnica_url = 'ficha_tecnico_carret.php?id=' . $producto['id'];
                        break;
                    case 'accesorios':
                        $ficha_tecnica_url = 'ficha_tecnico_acessorio.php?id=' . $producto['id'];
                        break;
                    case 'equipamiento':
                        $ficha_tecnica_url = 'ficha_tecnico_equipamiento.php?id=' . $producto['id'];
                        break;
                    default:
                        $ficha_tecnica_url = 'ficha_tecnica.php?id=' . $producto_id; // Si no hay categoría específica, se usa la ficha técnica genérica
                }
            
                echo "<div class='producto-en-lista' id='producto_" . $producto_id . "'>";
                // Enlace para ver la ficha técnica del producto
                echo "<a href='" . $ficha_tecnica_url . "'>";
                echo "<h2>" . htmlspecialchars($producto['nombre']) . "</h2>";
                echo "<p class='precio'>Precio: €" . htmlspecialchars($producto['precio']) . "</p>";
                echo '<img class="item-img" src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                echo "</a>";
                echo "<div>"; // Nuevo div para los botones
                echo '<form action="carrito.php" method="POST">';
                echo '<input type="hidden" name="producto_id" value="' . htmlspecialchars($producto['id']) . '">';
                echo '<input type="hidden" name="producto_nombre" value="' . htmlspecialchars($producto['nombre']) . '">';
                echo '<input type="hidden" name="producto_precio" value="' . htmlspecialchars($producto['precio']) . '">';
                echo '<input type="hidden" name="producto_imagen" value="' . ($producto['imagen']) . '">';
                echo '<button type="submit" name="add_to_cart" class="add-to-cart-btn">Añadir a la cesta</button>';
                echo '</form>';
                echo "<a href='listadeseos.php?eliminar=" . htmlspecialchars($producto_id) . "' class='eliminar'><img src='img/borrar.png' alt='Eliminar'></a>";
                echo "</div>"; // Cierre del nuevo div
                echo "</div>";
            }
            
            
        } else {
            echo "<p>No hay productos en la lista de deseos.</p>";
        }
        ?>
    </div>

    <script>
    // Función para eliminar producto de la lista de deseos
    function eliminarProducto(idProducto) {
        // Redirigir a listadeseos.php con el parámetro eliminar
        window.location.href = 'listadeseos.php?eliminar=' + idProducto;
    }
    </script>
    <?php require 'footer.php'; ?>
</body>
</html>
