<?php
// Verifica si la sesión está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si la sesión 'carrito' existe y no está vacía
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    // Obtiene la cantidad de productos en el carrito
    $cantidad_productos = count($_SESSION['carrito']);
} else {
    // Si no hay productos en el carrito, establece la cantidad en 0
    $cantidad_productos = 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEAD</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");

       * {
           margin: 0;
           padding: 0;
           text-decoration: none;
           border: none;
           outline: none;
           color: inherit;
           list-style: none;
           font-family: "Poppins";
       }

       body {
           background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;
       }

       header {
           position: sticky;
           top: 0;
           background: white;
           z-index: 999;
           display: flex;
           justify-content: space-between;
           align-items: center;
           padding: 1.5em 2em;
           box-shadow: 0 0 20px 0 black;
       }

       #navmenu {
           display: flex;
           gap: 1em;
       }

       #volver-catálogo {
           color: #fff;
           background-color: #007bff;
           padding: 8px 16px;
           border-radius: 4px;
           text-decoration: none;
           transition: background-color 0.3s ease;
       }

       #volver-catálogo:hover {
           background-color: #0056b3;
       }

       #carrito-link {
           position: relative;
           display: inline-block;
       }

       #carrito-link .carrito-cantidad {
           position: absolute;
           top: -8px;
           right: -8px;
           background-color: red;
           color: white;
           border-radius: 50%;
           padding: 4px;
           font-size: 12px;
           font-weight: bold;
       }

       .dropdown {
           position: relative;
           display: inline-block;
       }

       .dropdown-content {
           display: none;
           position: absolute;
           background-color: #f9f9f9;
           width: 160px;
           box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
           z-index: 1;
           top: 100%;
           
       }

       .dropdown-content a {
           color: black;
           padding: 12px 16px;
           text-decoration: none;
           display: block;
       }

       .dropdown-content a:hover {
           background-color: #f1f1f1;
       }

       .dropdown:hover .dropdown-content {
           display: block;
       }

       .carrito-container {
           position: relative;
           display: inline-block;
       }

       .carrito-desplegable {
           display: none;
           position: absolute;
           right: 0;
           background-color: white;
           min-width: 400px;
           box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
           z-index: 1;
           border: 1px solid #ddd;
           border-radius: 8px;
           padding: 10px;
       }

       .carrito-desplegable ul {
           list-style-type: none;
           margin: 0;
           padding: 0;
       }

       .carrito-desplegable li {
           padding: 10px;
           border-bottom: 1px solid #ddd;
           display: flex;
           align-items: center;
           justify-content: space-between;
       }

       .carrito-desplegable li img {
           width: 50px;
           height: auto;
           margin-right: 10px;
       }

       .carrito-desplegable .item-info {
           display: flex;
           align-items: center;
           
       }

       .carrito-desplegable .item-info span {
           margin-right: 10px;
       }

       .carrito-total {
           padding: 10px;
           font-size: 1.1em;
           text-align: left;
           font-weight: bold;
           border-top: 1px solid #ddd;
           background-color: #f9f9f9;
       }

       .ver-carrito-btn {
           display: block;
           text-align: center;
           padding: 10px;
           background-color: #007bff;
           color: #fff;
           text-decoration: none;
           border-radius: 0 0 8px 8px;
           transition: background-color 0.3s ease;
       }

       .ver-carrito-btn:hover {
           background-color: #35D83C;
       }
    </style>
</head>
<body>
<header>
    <a href="index.php"><img src="img/bikee.jpg" alt="logo"></a>
    <nav id="navmenu">
        <a href="index.php">Inicio</a>
        <div class="dropdown">
            <a class="dropbtn" href="catalogo.php">Catálogo ▽</a>
            <div class="dropdown-content">
                <a href="carretera_cliente.php">Carretera</a>
                <a href="ciudad_cliente.php">Ciudad</a>
                <a href="accesorio_cliente.php">Accesorios</a>
                
                <a href="equipamiento_cliente.php">Equipamiento</a>
            </div>
        </div>
        <a href="equipo.php">Nuestro equipo</a>
        <a href="contacto.php">Contacto</a>
        <a href="login.php"><img src="img/acceso.png" alt="Acceso"></a>
        <a href="listadeseos.php"><img src="img/me-gusta.png" alt="Lista de deseos"></a>

        <div class="carrito-container">
            <div id="carrito-link">
                <img src="img/carrito.png" alt="Carrito">
                <?php if ($cantidad_productos > 0) : ?>
                    <span class="carrito-cantidad"><?php echo htmlspecialchars($cantidad_productos); ?></span>
                <?php endif; ?>
            </div>
            <div id="carrito-desplegable" class="carrito-desplegable">
                <?php if (!empty($_SESSION['carrito'])) : ?>
                    <ul>
                        <?php 
                        $total = 0;
                        foreach ($_SESSION['carrito'] as $indice => $item) : 
                            $item_total = $item['cantidad'] * $item['precio'];
                            $total += $item_total;
                        ?>
                            <li>
                                <div class="item-info">
                                    <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                                    <span><?php echo htmlspecialchars($item['nombre']); ?></span>
                                    <span><?php echo htmlspecialchars($item['cantidad']); ?> x €<?php echo htmlspecialchars($item['precio']); ?></span>
                                </div>
                                <form method="post" action="eliminar_del_carrito.php" style="display:inline;">
                                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                                    <button type="submit" class="eliminar-btn" style="background:none; border:none; padding:0;">
                                        <img src="img/eli.png" style="width:20px; height:20px; margin-left:10px;">
                                    </button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="carrito-total">
                        <strong>Total: €<?php echo number_format($total, 2); ?></strong>
                    </div>
                    <a href="carrito.php" class="ver-carrito-btn">Ver carrito</a>
                <?php else : ?>
                    <p>Tu carrito está vacío</p>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carritoLink = document.getElementById('carrito-link');
        const carritoDesplegable = document.getElementById('carrito-desplegable');

        carritoLink.addEventListener('click', function(event) {
            event.preventDefault();
            carritoDesplegable.style.display = carritoDesplegable.style.display === 'block' ? 'none' : 'block';
        });

        // Cerrar el desplegable si se hace clic fuera del mismo
        document.addEventListener('click', function(event) {
            if (!carritoLink.contains(event.target) && !carritoDesplegable.contains(event.target)) {
                carritoDesplegable.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
