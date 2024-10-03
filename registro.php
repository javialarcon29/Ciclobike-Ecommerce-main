
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 120px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php require 'head_cliente_inicio.php'; ?>


<div class="container">
    <h2>Cree una cuenta para visualizar su pedido</h2>
    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="apellido1">Primer Apellido:</label>
        <input type="text" id="apellido1" name="primer_apellido" required>
        
        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" id="apellido2" name="segundo_apellido" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="correo" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        



        <input type="submit" value="Registrarse">
    </form>
</div>

</body>
</html>
