<?php
// Iniciar sesión antes de cualquier salida
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carretera.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px 0;
            gap: 1rem;
        }

        .item {
            width: 200px; /* Ancho deseado para cada artículo */
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            box-sizing: border-box;
            text-align: center; /* Centrar el contenido */
            height: 350px; /* Altura fija para todas las cajas */
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
            float: right; /* Cambiado a float: right; para alinear a la derecha */
            margin-right: 20px;
            margin-top: 20px; /* Agregado margen superior para separar del menú */
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

        .heart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .item:hover .heart-icon {
            display: block;
        }
    </style>
    <title>Catálogo de Equipamiento</title>
</head>
<body>
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
            <br><br><br>
            <div class="content-menu-filters-filter">
                Material
                <select id="material-select">
                    <option value="todos">Todos</option>
                    <option value="torso">Torso</option>
                    <option value="pierna">Piernas</option>
                    <option value="kit">Kit</option>
                </select>
            </div>
            <br><br><br>
            <div class="content-menu-filters-filter">
                Ordenar por precio
                <select id="sort-select">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
        </div>
        <div class="content-items" id="product-container">
            <div class="content-items-title"><br><br><br></div>
            <div class="items">
                <?php
                // Conexión a la base de datos
                $host = 'localhost';
                $dbname = 'proyect';
                $username = 'root';
                $password = '';

               

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para obtener productos de la base de datos
                    $query = $pdo->query("SELECT * FROM articulos WHERE categoria = 'equipamiento'");
                    $productos = $query->fetchAll(PDO::FETCH_ASSOC);

                    // Inicializar la lista de deseos si no existe
                    if (!isset($_SESSION['lista_deseos'])) {
                        $_SESSION['lista_deseos'] = array();
                    }

                    // Mostrar productos en la página con funcionalidad del carrito
                    foreach ($productos as $producto) {
                        $en_lista_deseos = isset($_SESSION['lista_deseos'][$producto['id']]);
                        $heart_icon = $en_lista_deseos ? 'corazonlleno.png' : 'cora.png';

                        echo '<div class="item" data-material="' . htmlspecialchars($producto['material']) . '">';
                        echo '<a href="ficha_tecnico_equipamiento.php?id=' . htmlspecialchars($producto['id']) . '">';
                        echo '<div class="item-img-wrapper">';
                        echo '<img class="item-img" src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                        echo '</div>';
                        echo '<div class="item-desc">';
                        echo '<p class="item-desc-title">' . htmlspecialchars($producto['nombre']) . '</p>';
                        echo '<p class="item-desc-price">' . htmlspecialchars($producto['precio']) . '€</p>';
                        echo '</div>';
                        echo '</a>';

                        // Icono de corazón para agregar a lista de deseos
                        echo '<img src="img/' . $heart_icon . '" class="heart-icon" alt="Agregar a lista de deseos" data-id="' . htmlspecialchars($producto['id']) . '" onclick="toggleWishlist(this)">';
                        
                        // Botón "Añadir a la cesta"
                        echo '<form class="add-to-cart-form">';
                        echo '<input type="hidden" name="producto_id" value="' . htmlspecialchars($producto['id']) . '">';
                        echo '<input type="hidden" name="producto_nombre" value="' . htmlspecialchars($producto['nombre']) . '">';
                        echo '<input type="hidden" name="producto_precio" value="' . htmlspecialchars($producto['precio']) . '">';
                        echo '<input type="hidden" name="producto_imagen" value="' . htmlspecialchars($producto['imagen']) . '">';
                        echo '<button type="submit" name="add_to_cart" class="add-to-cart-btn">Añadir a la cesta</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    echo "Error al conectar a la base de datos: " . htmlspecialchars($e->getMessage());
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
    // Verificar si se ha añadido un producto al carrito y mostrar SweetAlert
    <?php if (isset($_GET['added_to_cart']) && $_GET['added_to_cart'] === 'true') : ?>
        Swal.fire({
            title: "¡Producto añadido al carrito!",
            text: "Tu producto ha sido añadido correctamente al carrito.",
            icon: "success",
            confirmButtonText: "OK"
        }).then(() => {
            // Redirigir al catálogo después de cerrar el SweetAlert
            window.location.href = "carretera.php";
        });
    <?php endif; ?>
</script>

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
        });
    }
</script>

<?php require 'footer.php'; ?>

</body>
</html>
