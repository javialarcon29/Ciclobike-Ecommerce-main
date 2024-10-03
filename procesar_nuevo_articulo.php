<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (reemplaza los valores con los de tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyect";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        $response = array("status" => "error", "message" => "Error al conectar con la base de datos: " . $conn->connect_error);
        echo json_encode($response);
        exit(); // Detener la ejecución del script
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    // Procesar la imagen
    $imagen = $_FILES['imagen']['name']; // Nombre del archivo de imagen
    $imagen_temp = $_FILES['imagen']['tmp_name']; // Nombre temporal del archivo de imagen
    $descripcion = $_POST['descripcion'];
    $material = $_POST['material'];
    $categoria = $_POST['categoria'];

    // Mover la imagen al directorio deseado (reemplaza la ruta con la deseada)
    $ruta_imagen = "uploads/" . $imagen;
    move_uploaded_file($imagen_temp, $ruta_imagen);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO articulos (nombre, precio, imagen, descripcion, material, categoria) VALUES ('$nombre', '$precio', '$ruta_imagen', '$descripcion', '$material', '$categoria')";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Artículo añadido correctamente.");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error al añadir el artículo: " . $conn->error);
        echo json_encode($response);
    }

    // Cerrar la conexión
    $conn->close();
}
?>
