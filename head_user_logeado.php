<?php


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
    <title>Tu Carrito de Compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Agrega el enlace al archivo de estilos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       
       @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");
                /* RESETEO */
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


                body{
                    background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;



                    


                }
                /* NAV CON FLEX */
                #navmenu {
                    display: flex;
                    /* EN VEZ DE DAR PADDING A LOS BOTONES, AL SER SOLO PALABRAS USAMOS "GAP" QUE AGREGA ESPACIO ENTRE LOS ITEMS, DE ESTA FORMA NO HAY QUE DARLE UN ANCHO AL NAV/UL NI PADDING/MARGIN A LOS ENLACES */
                    gap: 1em;
                }

                /* HEADER CON FLEX */
                header {
                    /* EL HEADER QUEDA ARRIBA */
                    position: sticky;
                    top: 0;
                    background: white;
                    z-index: 999;
                    /* SEPARAR LOGO Y MENU */
                    display: flex;
                    justify-content: space-between;
                    align-items: baseline;
                    /* ESTILO */
                    padding: 1.5em 2em;
                    box-shadow: 0 0 20px 0 black;
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

        /* Estilos para el botón del carrito */
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
    </style>
</head>
<body>
       

    <header>
        <a href="index.php"><img src="img/bikee.jpg" alt="logo"></a>
        <nav id="navmenu">
            
            <a href="history_pedidos.php">Historial pedidos</a>
            <a href="micuenta.php">Mi cuenta</a>
            <a href="index.php"><img src="img/cerrar.png" alt="logo"></a>


            
            </a>
        </nav>
    </header>
</body>
</html>
