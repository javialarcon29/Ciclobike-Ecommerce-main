<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Ciclo Bike</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el body cubra toda la altura de la ventana */
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            flex: 1; /* Permite que el contenedor principal tome todo el espacio disponible */
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .contact-info p {
            margin: 10px 0;
            font-size: 16px;
        }
        .contact-form {
            border-top: 2px solid #333;
            padding-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .iframe-container {
            position: fixed;
            bottom: 100px; /* Ajustado para subir el chatbot */
            left: 20px;
            z-index: 9999; 
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .iframe-container iframe {
            width: 350px;
            height: 430px; 
            border: none; /* Elimina el borde predeterminado del iframe */
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            margin-top: auto; /* Empuja el footer al final de la página */
        }
    </style>
</head>
<body>

<?php require 'head_cliente_inicio.php'; ?>

<div class="container">
    <h1>Contacto - Ciclo Bike</h1>

    <div class="contact-info">
        <p><strong>Dirección:</strong> Av. Ciclovía, 123</p>
        <p><strong>Teléfono:</strong> +123 456 7890</p>
        <p><strong>Email:</strong> info@ciclobike.com</p>
    </div>

    <div class="contact-form">
        <h2>Envíanos un mensaje</h2>
        <form id="contact-form" action="enviar_correo.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Esperar a que el documento esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el formulario por su ID
        const form = document.getElementById("contact-form");

        // Agregar un evento al formulario para manejar el envío
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

            // Realizar la solicitud de envío del formulario utilizando Fetch API o AJAX
            fetch("enviar_correo.php", {
                method: "POST",
                body: new FormData(form) // Enviar los datos del formulario
            })
            .then(response => {
                if (response.ok) {
                    // Mostrar la alerta de éxito si la respuesta del servidor es exitosa
                    Swal.fire({
                        title: "¡Mensaje enviado!",
                        text: "Gracias por contactarnos. Te responderemos pronto.",
                        icon: "success"
                    });
                } else {
                    // Mostrar la alerta de error si hay algún problema con el envío
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un problema al enviar el mensaje. Inténtalo de nuevo más tarde.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error); // Mostrar el error en la consola
                // Mostrar la alerta de error genérico
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al enviar el mensaje. Inténtalo de nuevo más tarde.",
                    icon: "error"
                });
            });
        });
    });
</script>

<div class="iframe-container">
    <iframe
        allow="microphone;"
        src="https://console.dialogflow.com/api-client/demo/embedded/4130b065-c54a-4698-adc8-4145f204b41f">
    </iframe>
</div>

<?php require 'footer.php'; ?>

</body>
</html>
