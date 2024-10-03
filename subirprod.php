<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imágenes del Producto</title>
</head>
<body>
    <form action="subir_imagenes.php" method="post" enctype="multipart/form-data">
        <label for="producto_id">ID del Producto:</label>
        <input type="text" name="producto_id" id="producto_id" required>
        <label for="imagenes">Selecciona Imágenes:</label>
        <input type="file" name="imagenes[]" id="imagenes" multiple required>
        <button type="submit">Subir Imágenes</button>
    </form>
</body>
</html>
