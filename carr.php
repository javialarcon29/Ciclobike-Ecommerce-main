<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Carrito de Compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
        display: grid;
        grid-template-columns: 1fr 100px; /* Columna para el nombre y precio */
        gap: 10px;
        align-items: center;
    }

    .total-container {
        margin-top: 20px;
        display: grid;
        grid-template-columns: 1fr 100px;
        gap: 10px;
        align-items: center;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        color: black;
        text-decoration: none;
        border-radius: 4px;
    }

    #volver-catálogo {
        color: #fff; /* Color del texto */
        background-color: #007bff; /* Color de fondo del botón */
        padding: 8px 16px; /* Ajustar el espaciado interno */
        border-radius: 4px; /* Borde redondeado */
        text-decoration: none; /* Quitar subrayado del enlace */
        transition: background-color 0.3s ease; /* Transición suave al pasar el cursor */
    }

    #volver-catálogo:hover {
        color: #0056b3;
    }

    /* Estilos para el desplegable del carrito */
    #carrito-desplegable {
        display: none;
        position: absolute;
        top: 40px;
        right: 20px;
        width: 300px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }

    #carrito-desplegable ul {
        padding: 10px;
    }

    #carrito-desplegable li {
        padding: 8px 0;
        border-bottom: 1px solid #ddd;
    }

    #carrito-desplegable a {
        color: #333;
    }
    </style>
</head>
<body>

<?php require 'head_cliente_inicio.php'; ?>

<div class="container">
    <?php
    session_start();

    // Verificar si se ha enviado el formulario para añadir al carrito
    if (isset($_POST['add_to_cart'])) {
        // Crear un array asociativo con los datos del producto
        $producto = array(
            'nombre' => $_POST['producto_nombre'],
            'precio' => $_POST['producto_precio'],
            'imagen' => $_POST['producto_imagen']
        );

        // Agregar el producto al carrito usando un array de sesión
        $_SESSION['carrito'][] = $producto;

        // Mostrar mensaje de éxito
        echo '<p>Producto añadido al carrito correctamente.</p>';
    }

  // Mostrar contenido del carrito
if (!empty($_SESSION['carrito'])) {
    echo '<h2>Productos en el carrito:</h2>';
    echo '<ul>';
    $total = 0; // Variable para calcular el total
    foreach ($_SESSION['carrito'] as $key => $item) { // Añade el índice del elemento para identificarlo en el array
        $total += $item['precio']; // Sumar el precio de cada producto al total
        echo '<li>';
        echo '<p>' . $item['nombre'] . '</p>';
        echo '<p>Precio: ' . $item['precio'] . '€</p>';
        echo '<form method="post">';
        echo '<input type="hidden" name="eliminar_producto" value="' . $key . '">'; // Campo oculto con el índice del producto
        echo '<button type="submit" id="eliminar-producto-btn-' . $key . '">Eliminar producto</button>';
        echo '</form>';
        echo '</li>';
    }
    echo '</ul>';

    // Mostrar el total al final de la lista de productos
    echo '<div class="total-container">';
    echo '<p>Total:</p>';
    echo '<p>' . $total . '€</p>';
    echo '</div>';

    echo '<div class="botones-container">';
    echo '</div>';
} else {
    echo '<p>No hay productos en el carrito.</p>';
}
?>

<!-- Botón para mostrar/ocultar el desplegable del carrito -->
<a href="#" id="mostrar-carrito">Carrito</a>

<!-- Contenedor del desplegable del carrito -->
<div id="carrito-desplegable">
    <ul>
        <?php
        // Mostrar los productos en el desplegable del carrito
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                echo '<li>';
                echo '<p>' . $item['nombre'] . '</p>';
                echo '<p>Precio: ' . $item['precio'] . '€</p>';
                echo '</li>';
            }
        } else {
            echo '<li>No hay productos en el carrito.</li>';
        }
        ?>
    </ul>
    <a href="carretera_cliente.php" id="volver-carrito">Volver al catálogo</a>
    <a href="carretera.php" id="finalizar-compra">Finalizar compra</a>
</div>

<script>
// Script para mostrar/ocultar el desplegable del carrito
$(document).ready(function() {
    $('#mostrar-carrito').click(function(e) {
        e.preventDefault();
        $('#carrito-desplegable').toggle();
    });
});
</script>

</html>