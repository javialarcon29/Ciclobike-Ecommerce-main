<?php
// Iniciar sesión para usar la lista de deseos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
$host = 'localhost';
$dbname = 'proyect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los productos de la tabla "articulos"
    $query = $pdo->query("SELECT * FROM articulos");
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar la lista de deseos si no existe
    if (!isset($_SESSION['lista_deseos'])) {
        $_SESSION['lista_deseos'] = array();
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/catalogo.css"> <!-- Enlaza tu archivo CSS externo -->
    <title>Document</title>
    
    <!-- Otros elementos del head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    
    <style>
        /* Estilos CSS para los productos */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .item {
            width: calc(20% - 50px);
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        .item:hover .heart-img {
            display: block;
        }

        .item-img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .item-desc {
            margin-top: 10px;
        }

        .item-desc-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-desc-price {
            font-size: 14px;
        }

        .add-to-cart-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        .item-with-btn {
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item-img-wrapper {
            aspect-ratio: 1/1;
        }

        .heart-img {
            position: absolute;
            top: 0;
            right: 0;
            width: 30px;
            height: auto;
            z-index: 1;
            display: none;
        }

        .clasificacion {
            direction: rtl;
            unicode-bidi: bidi-override;
        }

        label:hover,
        label:hover ~ label {
            color: orange;
        }

        input[type="radio"]:checked ~ label {
            color: orange;
        }

        /* Media queries for responsiveness */
        @media (max-width: 1200px) {
            .item {
                width: calc(25% - 40px);
            }
        }

        @media (max-width: 992px) {
            .item {
                width: calc(33.33% - 30px);
            }
        }

        @media (max-width: 768px) {
            .item {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .item {
                width: calc(100% - 20px);
            }

            .item-desc-title {
                font-size: 14px;
            }

            .item-desc-price {
                font-size: 12px;
            }

            .add-to-cart-btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <?php require 'head_cliente_inicio.php'; ?>
    <?php require 'menu_catalogo_cliente.php'; ?>

    <div class="container">
        <?php
        foreach ($productos as $producto) {
            $ficha_tecnica_url = '';
            switch ($producto['categoria']) {
                case 'ciudad':
                    $ficha_tecnica_url = 'ficha_tecnico_ciudad.php';
                    break;
                case 'carretera':
                    $ficha_tecnica_url = 'ficha_tecnico_carret.php';
                    break;
                case 'accesorios':
                    $ficha_tecnica_url = 'ficha_tecnico_acessorio.php';
                    break;
                case 'equipamiento':
                    $ficha_tecnica_url = 'ficha_tecnico_equipamiento.php';
                    break;
                default:
                    $ficha_tecnica_url = '#';
            }

            $en_lista_deseos = isset($_SESSION['lista_deseos'][$producto['id']]);
            $heart_icon = $en_lista_deseos ? 'corazonlleno.png' : 'cora.png';

            echo '<div class="item item-with-btn clasificacion" data-material="' . $producto['material'] . '">';
            echo '<img src="img/' . $heart_icon . '" alt="Corazón" class="heart-img" data-id="' . $producto['id'] . '" onclick="toggleWishlist(this)">';
            echo '<a href="' . $ficha_tecnica_url . '?id=' . $producto['id'] . '">';
            echo '<div class="item-img-wrapper">';
            echo '<img class="item-img" src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">';
            echo '</div>';
            echo '<div class="item-desc">';
            echo '<p class="item-desc-title">' . $producto['nombre'] . '</p>';
            echo '<p class="item-desc-price">' . $producto['precio'] . '€</p>';
            echo '</div>';
            echo '</a>';
            echo '<form class="add-to-cart-form">';
            echo '<input type="hidden" name="producto_id" value="' . $producto['id'] . '">';
            echo '<input type="hidden" name="producto_nombre" value="' . $producto['nombre'] . '">';
            echo '<input type="hidden" name="producto_precio" value="' . $producto['precio'] . '">';
            echo '<input type="hidden" name="producto_imagen" value="' . $producto['imagen'] . '">';
            echo '<button type="submit" name="add_to_cart" class="add-to-cart-btn">Añadir a la cesta</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
    <?php require 'footer.php'; ?>

    <script>
         function toggleWishlist(element) {
        var productId = element.getAttribute('data-id');
        var isInWishlist = element.getAttribute('src').includes('corazonlleno.png');

        $.ajax({
            url: 'toggle_wishlist.php',
            method: 'POST',
            data: { product_id: productId },
            success: function(response) {
                if (isInWishlist) {
                        element.src = 'img/cora.png';
                        Swal.fire('¡Eliminado!', 'Producto eliminado de la lista de deseos', 'success');
                    } else {
                        element.src = 'img/corazonlleno.png';
                        Swal.fire('¡Agregado!', 'Producto agregado a la lista de deseos', 'success');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Hubo un problema al actualizar la lista de deseos', 'error');
                }
        });
    }


    function toggleWishlist(element) {
        var productoId = $(element).data('id');

        $.ajax({
            url: 'agregar_a_lista_deseos.php',
            type: 'POST',
            data: {producto_id: productoId},
            dataType: 'json',
            success: function(response){
                if(response.status === 'added'){
                    $(element).attr('src', 'img/corazonlleno.png');
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto añadido a la lista de deseos',
                        text: 'El producto ha sido añadido a tu lista de deseos.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    $(element).attr('src', 'img/cora.png');
                    Swal.fire({
                        icon: 'error',
                        title: 'Producto eliminado de la lista de deseos',
                        text: 'El producto ha sido eliminado de tu lista de deseos.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-form').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: 'add_to_cart.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
