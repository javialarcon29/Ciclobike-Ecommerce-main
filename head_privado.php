<?php
// Inicia la sesión si no está iniciada


// Verifica si se ha enviado una solicitud para cerrar la sesión
if (isset($_GET['cerrar_sesion'])) {
    // Elimina todas las variables de sesión
    session_unset();

    // Destruye la sesión
    session_destroy();

    // Redirige al usuario a la página de inicio (index.php)
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 

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


</style>




    </style>
</head>
<body>
    <header>
    <a href="index.php"><img src="img/bikee.jpg" alt="logo"></a>
        <nav id="navmenu">
           

            <a href="admin.php">PEDIDOS CLIENTES</a>
            <a href="añadirarticulo.php">AÑADIR ARTICULOS</a>
            <a href="index.php"><img src="img/cerrar.png" alt="logo"></a>
    

           
  
        </nav>
    </header>
</body>
</html>

