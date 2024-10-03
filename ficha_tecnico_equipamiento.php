<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
.container {
    width: 80%;
    max-width: 1200px;
    margin: 20px auto; /* Reduce el margen vertical */
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    animation: slideUp 0.5s ease-out;
    height: auto; /* Asegúrate de que la altura se ajuste al contenido */
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px; /* Reduce el margen inferior */
    border-bottom: 2px solid #eee;
    padding-bottom: 5px; /* Reduce el padding inferior */
    text-align: center; /* Centrar el texto */
}

.item-img {
    width: 100%;
    max-width: 300px; /* Reduce el tamaño máximo de la imagen */
    display: block;
    margin: 0 auto 10px auto; /* Reduce el margen inferior */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

p {
    color: #555;
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 10px; /* Reduce el margen inferior */
    text-align: center; /* Centrar el texto */
}

strong {
    color: #333;
}

.add-to-cart-btn {
    display: inline-block;
    background-color: #28a745;
    color: #fff;
    padding: 8px 16px; /* Reduce el padding */
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
    margin: 0 auto; /* Centrar el botón */
}

.add-to-cart-btn:hover {
    background-color: #218838;
}

.review-box {
    margin-top: 30px; /* Reduce el margen superior */
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 100%;
    max-width: 800px; /* Limitar el ancho de la caja de reseñas */
}

.review-box h2 {
    font-size: 20px;
    margin-bottom: 10px; /* Reduce el margen inferior */
    color: #333;
    text-align: center; /* Centrar el texto */
}

.form-group {
    margin-bottom: 10px; /* Reduce el margen inferior */
    text-align: center; /* Centrar el contenido del grupo de formulario */
}

.form-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px; /* Reduce el padding */
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #80bdff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

.review-btn {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px; /* Reduce el padding */
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
    margin: 0 auto; /* Centrar el botón */
}


.review-btn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<?php require_once 'head_cliente_inicio.php'; ?>

<div class="container">
    <?php
    // Conectar a la base de datos (reemplaza los valores con los de tu base de datos)
    $host = 'localhost';
    $dbname = 'proyect';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si se ha proporcionado un ID válido en la URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            // Obtener el ID del producto desde la URL
            $producto_id = $_GET['id'];

            // Consulta SQL para obtener los datos del producto
            $sql = "SELECT * FROM articulos WHERE categoria = 'equipamiento' AND id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $producto_id, PDO::PARAM_INT);
            $stmt->execute();
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mostrar la ficha técnica del producto si se encontró
            if ($producto) {
                echo '<h2>' . $producto['nombre'] . '</h2>';        
                echo '<img class="item-img" src="' . ($producto['imagen']) . '" alt="' . $producto['nombre'] . '"><br><br><br><br>';
                echo '<p><strong>Descripción:</strong> ' . $producto['descripcion'] . '</p><br><br>';
                echo '<p><strong>Precio: ' . $producto['precio'] . '€</strong></p><br>';

                // Formulario para añadir al carrito
                echo '<form action="carrito.php" method="post">';
                echo '<input type="hidden" name="add_to_cart" value="1">';
                echo '<input type="hidden" name="producto_id" value="' . $producto['id'] . '">';
                echo '<input type="hidden" name="producto_nombre" value="' . $producto['nombre'] . '">';
                echo '<input type="hidden" name="producto_precio" value="' . $producto['precio'] . '">';
                echo '<input type="hidden" name="producto_imagen" value="' . $producto['imagen'] . '">';
                
                
                // Opción para seleccionar la talla
                echo '<label for="talla">Selecciona tu talla:</label>';
                echo '<select name="talla" id="talla">';
                echo '<option value="XS">XS</option>';
                echo '<option value="S">S</option>';
                echo '<option value="M">M</option>';
                echo '<option value="L">L</option>';
                echo '<option value="XL">XL</option>';
                echo '</select>';
                echo '<button type="submit" class="add-to-cart-btn">Añadir a la cesta</button>';
                echo '</form>';

                // Mostrar más detalles del producto según tus necesidades
            } else {
                echo '<p>Producto no encontrado.</p>';
            }
        } else {
            echo '<p>ID de producto inválido.</p>';
        }
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
    ?>
</div>

</body>
</html>
