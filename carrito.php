<?php
session_start();
require 'head_cliente_inicio.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Carrito de Compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=ARJaV6678J1BOHgHkqY1PVSmNNSm6wE_ZdgwNDCZsEsRIztnRKKfh12TykNgvbVko4GLAkJms5pVdOvs&currency=USD"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
/* Agrega una animación para la entrada del formulario */
@keyframes entradaFormulario {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Aplica la animación de entrada al formulario */
.animar-entrada {
    animation: entradaFormulario 0.5s forwards;
}



        /* Estilos generales */
        .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;

}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
    display: flex;
    align-items: center;
}

img {
    max-width: 100px;
    margin-right: 20px;
}

p {
    margin: 0;
}

.actualizar-cantidad-form {
    display: flex;
    align-items: center;
}

.actualizar-cantidad-form label {
    font-weight: bold;
    margin-right: 10px;
}

.actualizar-cantidad-form input[type="number"] {
    width: 50px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.eliminar-producto-form {
    margin-top: 10px;
}

.eliminar-producto-btn {
    background-color: #dc3545;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.total-container {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.botones-container {
    margin-top: 20px;
    text-align: right;
}

.botones-container a {
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    padding: 10px 20px;
    border-radius: 4px;
    margin-left: 10px;
}

.botones-container a:hover {
    background-color: #0056b3;
}


#confirmar_compra_btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 50px 10px 20px; /* Aumenta el padding para aumentar la anchura */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    background-image: url('img/pagar.png'); /* Ruta relativa a la imagen en la carpeta img */
    background-repeat: no-repeat;
    background-position: right center; /* Posiciona la imagen a la derecha y al centro */
    margin-top: 20px; /* Agrega un espacio superior al botón */

}

#confirmar_compra_btn:hover {
    background-color: #45a049;
}


/*FORMULARIO SIN PAYPAL -------------------------------*/
/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

/* Estilos para el formulario */
.confirmar-compra-form {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

/* Estilos para los grupos de formulario */
.form-group {
    margin-bottom: 20px;
}

/* Estilos para las etiquetas */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Estilos para los campos de entrada */
input[type="text"],
input[type="email"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Estilos para el botón */
#confirmar_compra_btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#confirmar_compra_btn:hover {
    background-color: #0056b3;
}



 
    </style>
</head>
<body>

<div class="container">
<?php

// Procesar la actualización de la cantidad del producto en el carrito
if (isset($_POST['actualizar_cantidad'])) {
    $key = $_POST['actualizar_cantidad'];
    $cantidad = $_POST['cantidad'];
    
    // Verificar si la cantidad es válida (mayor que 0)
    if ($cantidad > 0) {
        $_SESSION['carrito'][$key]['cantidad'] = $cantidad;
    } else {
        // Si la cantidad es menor o igual a 0, eliminar el producto del carrito
        unset($_SESSION['carrito'][$key]);
    }
}

// Verificar si se ha enviado el formulario para añadir al carrito
if (isset($_POST['add_to_cart'])) {
    // Obtener los datos del producto que se está añadiendo al carrito
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['producto_nombre'];
    $precio = $_POST['producto_precio'];
    $imagen = $_POST['producto_imagen'];

    // Inicializar la cantidad en 1
    $cantidad = 1;

    // Verificar si el producto ya está en el carrito
    $producto_existente = false;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $item) {
            if ($item['id'] === $producto_id) {
                // Si el producto ya está en el carrito, incrementa la cantidad en $cantidad
                $_SESSION['carrito'][$key]['cantidad'] += $cantidad;
                $producto_existente = true;
                break;
            }
        }
    }

    // Si el producto no está en el carrito, lo agrega
    if (!$producto_existente) {
        $producto = array(
            'id' => $producto_id,
            'nombre' => $nombre,
            'precio' => $precio,
            'imagen' => $imagen,
            'cantidad' => 1 // Inicializar la cantidad en 1
        );

        // Añadir el producto al carrito
        $_SESSION['carrito'][] = $producto;
    }
}

// Función para eliminar un producto del carrito
function eliminar_producto($key) {
    if (isset($_SESSION['carrito'][$key])) {
        unset($_SESSION['carrito'][$key]);
    }
}

// Mostrar contenido del carrito
if (!empty($_SESSION['carrito'])) {
    echo '<h2>Productos en el carrito:</h2>';
    echo '<ul>';
    $total = 0; // Variable para calcular el total
    foreach ($_SESSION['carrito'] as $key => $item) {
        $subtotal = $item['precio'] * $item['cantidad']; // Calcular subtotal por producto
        $total += $subtotal; // Sumar al total
        echo '<li>';

        echo '<img src="' . $item['imagen'] . '" alt="' . $item['nombre'] . '" style="max-width: 100px;">';
        echo '<p><strong>Producto:</strong> ' . $item['nombre'] . '</p>';
        echo '<p><strong>Precio:</strong> ' . $item['precio'] . '€</p>';
        echo '<form method="post" class="actualizar-cantidad-form">';
        echo '<input type="hidden" name="actualizar_cantidad" value="' . $key . '">'; // Agregar un campo oculto para identificar el producto
        echo '<strong><label for="cantidad">Cantidad:</label></strong>';
        echo '<input type="number" name="cantidad" value="' . $item['cantidad'] . '" min="1" required onchange="this.form.submit()" style="width: 50px;">'; // Campo de entrada para la cantidad con ancho de 50px
        echo '</form>';
        echo '<p><strong>Subtotal:</strong> ' . $subtotal . '€</p>';

        echo '<form method="post" class="eliminar-producto-form">';
        echo '<input type="hidden" name="eliminar_producto" value="' . $key . '">';
        echo '<button type="submit" class="eliminar-producto-btn">Eliminar producto</button>';
        echo '</form>';

        echo '</li>';
    }

    echo '</ul>';

    // Mostrar el total al final de la lista de productos
    echo '<div class="total-container">';
    echo '<p>Total:</p>';
    echo '<p><strong>' . $total . '€</strong></p>';
    echo '</div>';

    echo '<div class="botones-container">';
    echo '</div>';
} else {
    echo '<p>No hay productos en el carrito.</p>';
}
?>


<br>






        <h2>Complete los siguientes campos para continuar con su compra y poder procesar su pago de manera exitosa </h2>
<form method="post" action="quierescrearcuenta.php" class="confirmar-compra-form">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="primer_apellido">Primer apellido:</label>
    <input type="text" name="primer_apellido" required><br>

    <label for="segundo_apellido">Segundo Apellido:</label>
    <input type="text" name="segundo_apellido" required><br>

    <label for="direccion">Dirección domicilio:</label>
    <input type="text" name="direccion" required><br>

    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" required><br>

    <label for="municipio">Municipio:</label>
    <input type="text" name="municipio" required><br>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required><br>

    <button id="confirmar_compra_btn" type="submit" name="confirmar_compra">Confirmar Compra</button>
</form>



                                    <!-- Contenido adicional que quieres mostrar después de confirmar la compra -->
                                    <div id="contenido-adicional" style="display: none;">
                                        <div id="paypal-button-container"></div>
                                    <div class="flex flex-col items-center justify-center section-card-modal rounded overflow-hidden cursor-pointer text-white shadow-lg animate-slide-down"
                                        onmouseover="mostrarDiv()">
                                        <div class="border-b-2">
                                            <div class="font-bold text-lg">
                                            
                                            </div>
                                            <div class="mt-1 mb-1 model-methods">
                                                <a class="text-lg text-blue-500 font-bold" target="_blank"
                                                    href="https://app.airtm.com/send-or-request/send"></a>
                                                <div class="flex">
                                                    <p class="mt-1 mb-1 text-lg font-bold">
                                                        <span id="email"></span>
                                                    </p>
                                                    <button onclick="copyMail()"><i class="far fa-copy ml-5"></i></button>
                                                </div>
                                            </div>






    </div>
</div>

</div>

<script>
    // Script para eliminar producto del carrito al enviar el formulario
    $(document).ready(function(){
        $('.eliminar-producto-form').submit(function(event){
            event.preventDefault(); // Evitar el envío del formulario
            var formData = $(this).serialize(); // Obtener datos del formulario
            $.post('eliminar_producto.php', formData, function(response){
                location.reload(); // Recargar la página después de eliminar el producto
            });
        });
    });

    var total_carrito = <?php echo !empty($_SESSION['carrito']) ? $total : 0; ?>;

    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total_carrito // Monto del pago
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
        console.log(details);
        
        // Mostrar SweetAlert en lugar de la alerta estándar
        Swal.fire({
            title: 'Estimado ' + details.payer.name.given_name + '<p>¡Su pago ha sido completado con exito!</p>',
            icon: 'success', // Icono de éxito
            showCancelButton: false, // No mostrar botón de cancelar
            showConfirmButton: false, // No mostrar botón de confirmar
            timer: 4000 // Duración en milisegundos antes de cerrar automáticamente
        });
                                        // Aquí puedes agregar acciones adicionales después de que se complete el pago
                                        const url = 'hola.php';
                                        const options = {
                                        method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json' // Indica que estás enviando datos JSON en el cuerpo de la solicitud
                                    },
                                    body: JSON.stringify(details) // Convierte los datos a formato JSON
                                    
                                    };
                                // Realiza la solicitud POST utilizando fetch
                                fetch(url, options)
                                    .then(response => {
                                        // Verifica si la respuesta fue exitosa
                                        if (!response.ok) {
                                            throw new Error('Ocurrió un error al realizar la solicitud.');
                                        }
                                        // Devuelve la respuesta como JSON
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Maneja la respuesta recibida
                                        console.log('Respuesta del servidor:', data);
                                    })
                                    .catch(error => {
                                        // Maneja cualquier error que ocurra durante la solicitud
                                        console.error('Error:', error);
                                    });
                                            });
                                        }
                                    }).render('#paypal-button-container');

</script>

</body>
</html>


<!------------------------------RESPUESTA DE DATOS DE PAYPAL --------------------------------------------------------->
<?php


$clientId = "ARJaV6678J1BOHgHkqY1PVSmNNSm6wE_ZdgwNDCZsEsRIztnRKKfh12TykNgvbVko4GLAkJms5pVdOvs";
$clientSecret = "EDR1Y3zH4K1r4_RSaa-ZDPQmGHZmPEkKQZ4gTB-osbOwpWJNBbSUNJoEK2O4ttRVfRUKzr8QGFQCi7YS";

$webhookUrl = "https://16f3-66-81-180-166.ngrok-free.app/proyecto-dia-19-abril-main/hola.php"; // Cambia esto por tu URL de webhook de la empresa o de casa ( depende donde me encunetre )

$data = array(
    "url" => $webhookUrl,
    "event_types" => array(
        array("name" => "PAYMENT.CAPTURE.COMPLETED"),
        array("name" => "CHECKOUT.ORDER.COMPLETED"),
   
    )
);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/notifications/webhooks",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode("$clientId:$clientSecret")
    ),
));

$response = curl_exec($curl);


curl_close($curl);
?>




</div>



<script>
document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.querySelector('.confirmar-compra-form');
    var contenidoAdicional = document.getElementById('contenido-adicional');

    // Retraso para aplicar la animación de entrada
    setTimeout(function() {
        formulario.classList.add('animar-entrada');
    }, 500); // Ajusta el tiempo de retraso según sea necesario

    formulario.addEventListener('submit', function(event) {
        event.preventDefault(); 

        // Aquí podrías agregar código para enviar los datos del formulario al servidor si es necesario

        // Oculta el formulario y muestra el contenido adicional
        formulario.style.display = 'none';
        contenidoAdicional.style.display = 'block';
    });
});
</script>







</body>
</html>