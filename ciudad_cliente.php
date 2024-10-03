<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/carretera.css">
    <style>
        .items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px 0;
            gap: 1rem;
        }

        .item {
            width: 200px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item img {
            object-fit: contain;
        }

        .item-desc {
            margin-top: 10px;
        }

        .item-desc p {
            margin: 5px 0;
        }

        .add-to-cart-btn {
            display: block;
            margin: auto;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }

        .search-container {
            float: right;
            margin-right: 20px;
            margin-top: 20px;
        }

        .search-container form {
            display: inline-block;
        }

        .search-container input[type=text],
        .search-container button {
            padding: 6px;
            margin: 0;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }

        .content-menu {
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
        }

        .content-menu-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .content-menu-filters-filter {
            margin-bottom: 10px;
        }

        .content-menu-filters-filter select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
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

        .item:hover .heart-img {
            display: block;
        }
    </style>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'proyect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener productos de la base de datos con la categoría "ciudad"
    $query = $pdo->query("SELECT * FROM articulos WHERE categoria = 'ciudad'");
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar la lista de deseos si no existe
    if (!isset($_SESSION['lista_deseos'])) {
        $_SESSION['lista_deseos'] = array();
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
<?php require 'head_cliente_inicio.php'; ?>
<?php require 'menu_catalogo_cliente.php'; ?>

<div class="wrapper">
    <div class="head"></div>

    <!-- Agregar formulario de búsqueda -->
    <div class="search-container">
        <form action="#" method="GET" id="search-form">
            <input type="text" placeholder="Buscar productos..." name="search" id="search-input">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="content">
        <div class="content-menu">
            <div class="content-menu-title">Filtro:</div>
            <div class="content-menu-filters-filter">
                Rango de precio
                <input type="number" placeholder="Mínimo" id="min-price">
                <input type="number" placeholder="Máximo" id="max-price">
            </div>
            <div class="content-menu-filters-filter">
                Material
                <select id="material-select">
                    <option value="todos">Todos</option>
                    <option value="carbono">Carbono</option>
                    <option value="aluminio">Aluminio</option>
                </select>
            </div>
            <div class="content-menu-filters-filter">
                Ordenar por precio
                <select id="sort-select">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
        </div>
        <div class="content-items" id="product-container">
            <div class="content-items-title"></div>
            <div class="items">
                <?php
                foreach ($productos as $producto) {
                    $en_lista_deseos = isset($_SESSION['lista_deseos'][$producto['id']]);
                    $heart_icon = $en_lista_deseos ? 'corazonlleno.png' : 'cora.png';

                    echo '<div class="item" data-material="' . $producto['material'] . '">';
                    echo '<img src="img/' . $heart_icon . '" alt="Corazón" class="heart-img" data-id="' . $producto['id'] . '" onclick="toggleWishlist(this)">';
                    echo '<a href="ficha_tecnico_ciudad.php?id=' . $producto['id'] . '">';
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
        </div>
    </div>
</div>

<script src="js/buscador.js"></script>
<script src="js/ordenarprecio.js"></script>
<script src="js/asc_desc.js"></script>
<script src="js/aleacion.js"></script>

<script>
    function toggleWishlist(element) {
        var productoId = element.getAttribute('data-id');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'agregar_a_lista_deseos.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'added') {
                    element.src = 'img/corazonlleno.png';
                } else if (response.status === 'removed') {
                    element.src = 'img/cora.png';
                }
            }
        };
        xhr.send('producto_id=' + productoId);
    }

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

        $('#search-form').on('submit', function(event){
            event.preventDefault();
            var searchValue = $('#search-input').val().toLowerCase();

            $('.item').each(function(){
                var itemName = $(this).find('.item-desc-title').text().toLowerCase();
                if(itemName.includes(searchValue)){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#min-price, #max-price').on('input', function(){
            var minPrice = parseFloat($('#min-price').val()) || 0;
            var maxPrice = parseFloat($('#max-price').val()) || Infinity;

            $('.item').each(function(){
                var itemPrice = parseFloat($(this).find('.item-desc-price').text().replace('€', ''));
                if(itemPrice >= minPrice && itemPrice <= maxPrice){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#material-select').on('change', function(){
            var selectedMaterial = $(this).val();

            $('.item').each(function(){
                var itemMaterial = $(this).data('material');
                if(selectedMaterial === 'todos' || itemMaterial === selectedMaterial){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#sort-select').on('change', function(){
            var sortOrder = $(this).val();
            var items = $('.item').toArray();

            items.sort(function(a, b){
                var priceA = parseFloat($(a).find('.item-desc-price').text().replace('€', ''));
                var priceB = parseFloat($(b).find('.item-desc-price').text().replace('€', ''));
                return sortOrder === 'asc' ? priceA - priceB : priceB - priceA;
            });

            $('.items').html(items);
        });
    

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
        })}
</script>
</body>
</html>
