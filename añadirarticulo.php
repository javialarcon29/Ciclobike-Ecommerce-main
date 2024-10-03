<?php
    // Verificar si se envió el formulario de agregar artículo
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Conectar a la base de datos (reemplaza los valores de conexión con los tuyos)
        $conexion = mysqli_connect("localhost", "root", "", "proyect");

        // Verificar la conexión
        if ($conexion === false) {
            die("Error: No se pudo conectar. " . mysqli_connect_error());
        }

        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $material = $_POST["material"];
        $categoria = $_POST["categoria"];

        // Procesar la imagen
        $imagen = $_FILES["imagen"]["name"];
        $imagen_temporal = $_FILES["imagen"]["tmp_name"];
        $ruta_imagen = "img/" . $imagen;

        // Mover la imagen al directorio de uploads
        move_uploaded_file($imagen_temporal, $ruta_imagen);

        // Insertar los datos del artículo en la base de datos
        $sql = "INSERT INTO articulos (nombre, precio, imagen, descripcion, material, categoria) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sdssss", $nombre, $precio, $ruta_imagen, $descripcion, $material, $categoria);
            if (mysqli_stmt_execute($stmt)) {
            $response = array("status" => "success", "message" => "Artículo añadido correctamente.");
            } else {
                $response = array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = array("status" => "error", "message" => "Error al preparar la consulta: " . mysqli_error($conexion));
        }

        mysqli_close($conexion);

        // Enviar la respuesta al cliente en formato JSON
        echo json_encode($response);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    height: 100vh;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #343a40;
    color: #fff;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.sidebar-header {
    padding: 20px;
    background-color: #23272b;
    text-align: center;
}

.sidebar-header h2 {
    margin: 0;
    font-size: 24px;
}

.menu {
    flex-grow: 1;
}

.menu ul {
    list-style-type: none;
    padding: 0;
}

.menu ul li {
    width: 100%;
}

.menu ul li a {
    display: block;
    padding: 15px 20px;
    color: #fff;
    text-decoration: none;
    transition: background 0.3s;
}

.menu ul li a:hover {
    background-color: #495057;
}

.main-content {
    flex-grow: 1;
    background-color: #f8f9fa;
    display: flex;
    flex-direction: column;
}

.header {
    padding: 20px;
    background-color: #e9ecef;
    border-bottom: 1px solid #dee2e6;
}

.header h1 {
    margin: 0;
    font-size: 28px;
}

.content {
    padding: 20px;
}
</style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
            <h2>Panel de administrador </h2>
            </div>
            <nav class="menu">
                <ul>
                <li><a href="admin.php">Pedidos</a></li>
                    <li><a href="usuarios.php">Listado de usuarios</a></li>
                    <li><a href="inventario.php">Inventario Artículos</a></li>
                    <li><a href="añadirarticulo.php">Añadir Articulo</a></li>
                    <li><a href="index.php">Salir</a></li>

                </ul>
            </nav>
        </aside>
        <main class="main-content">
    <header class="header">
       
    </header>
    <section class="content">
       <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Artículo</title>
    <style>
      
        h1 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
            padding-right: 30px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<br>
<br>

<h1>Añadir Artículo</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br><br>
    
    <label for="precio">Precio:</label>
    <input type="number" name="precio" id="precio" min="0" step="0.01" required><br><br>
    
    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen" accept="image/*" required><br><br>

    
    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" id="descripcion" cols="30" rows="5" required></textarea><br><br>
    
    <label for="material">Material:</label>
    <select name="material" id="material" required>
        <option value="todos">Todos</option>
        <option value="carbono">Carbono</option>
        <option value="aluminio">Aluminio</option>
    </select><br><br>
    
    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria" required>
        <option value="ciudad">Ciudad</option>
        <option value="carretera">Carretera</option>
        <option value="equipamiento">Equipamiento</option>
        <option value="accesorios">Accesorios</option>
                    <option value="pared">Soporte pared</option>
                    <option value="suelo">Soporte suelo</option>
                    <option value="suj">Sujeccion</option>
                    <option value="kit">Kit</option>
    </select><br><br>
    
    <input type="submit" value="Añadir Artículo">
</form>

</body>
</html>
    </section>
</main>

    </div>


      <!-- Script para mostrar SweetAlert2 -->
      <script>
        // Función para mostrar SweetAlert2
        function showAlert(status, message) {
            Swal.fire({
                icon: status === "success" ? 'success' : 'error',
                title: status === "success" ? 'Éxito' : 'Error',
                text: message
            });
        }

        // Verificar si hay un mensaje de respuesta del servidor
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "showAlert('" . $response["status"] . "', '" . $response["message"] . "');";
        }
        ?>
    </script>
</body>
</html>
