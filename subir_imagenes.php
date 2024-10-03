<?php
// Conectar a la base de datos
$host = 'localhost';
$dbname = 'proyect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagenes']) && isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];
        $imagenes = $_FILES['imagenes'];

        $uploadDir = 'uploads/'; // Directorio donde se guardarán las imágenes
        $imagenesUrls = [];

        for ($i = 0; $i < count($imagenes['name']); $i++) {
            $imageTmpName = $imagenes['tmp_name'][$i];
            $imageName = basename($imagenes['name'][$i]);
            $uploadFilePath = $uploadDir . $imageName;

            if (move_uploaded_file($imageTmpName, $uploadFilePath)) {
                $imagenesUrls[] = $uploadFilePath;
            }
        }

        if (!empty($imagenesUrls)) {
            $imagenesUrlsString = implode(',', $imagenesUrls);
            $sql = "UPDATE articulos SET imagenes = :imagenes WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagenes', $imagenesUrlsString);
            $stmt->bindParam(':id', $producto_id, PDO::PARAM_INT);
            $stmt->execute();
            echo "Imágenes subidas y guardadas correctamente.";
        } else {
            echo "Error al subir las imágenes.";
        }
    } else {
        echo "Formulario inválido.";
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
