<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;
            margin: 0;
            padding: 0;
        }
        .container {
    max-width: 500px;
    margin: 200px auto; /* Aumenté el margen superior e inferior a 80px */
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center; /* Para centrar el botón */
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
    <h2>Iniciar Sesión</h2>
    <form action="procesar_login.php" method="POST">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="correo" required>
       
        <label for="password">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
       
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="recuperar_contrasena.php">¿Has olvidado tu contraseña?</a>
    <br><br>
    <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
</div>
 
</body>
</html>
 