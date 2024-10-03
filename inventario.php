<?php
// Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
$dsn = 'mysql:host=localhost;dbname=proyect';
$usuario = 'root';
$contraseña = '';

try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar el formulario de edición si se ha enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha enviado el formulario de edición
        if (isset($_POST["edit_id"])) {
            // Obtener el ID del artículo a editar
            $edit_id = $_POST["edit_id"];

            // Obtener otros datos del formulario
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $descripcion = $_POST["descripcion"];
            $material = $_POST["material"];
            $categoria = $_POST["categoria"];
      

            // Verificar si se cargó una nueva imagen
            if (isset($_FILES["nueva_imagen"]) && $_FILES["nueva_imagen"]["error"] === UPLOAD_ERR_OK) {
                // Ruta donde se guardará la imagen cargada
                $directorio_destino = "uploads/";
                
                // Nombre del archivo
                $nombre_archivo = $_FILES["nueva_imagen"]["name"];
                
                // Ruta completa del archivo
                $ruta_destino = $directorio_destino . $nombre_archivo;
                
                // Mover el archivo cargado al directorio de destino
                move_uploaded_file($_FILES["nueva_imagen"]["tmp_name"], $ruta_destino);

                // Actualizar la ruta de la imagen en la base de datos
                $sql_update = "UPDATE articulos SET imagen = :imagen WHERE id = :id";
                $stmt = $conexion->prepare($sql_update);
                $stmt->bindParam(':imagen', $ruta_destino);
                $stmt->bindParam(':id', $edit_id);
                $stmt->execute();
            }

            // Actualizar otros campos del artículo en la base de datos
            $sql_update = "UPDATE articulos SET nombre = :nombre, precio = :precio, descripcion = :descripcion, material = :material, categoria = :categoria, cantidad = :cantidad WHERE id = :id";
            $stmt = $conexion->prepare($sql_update);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':material', $material);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':id', $edit_id);
            $stmt->execute();
        }
    }

    // Obtener los datos actualizados de los artículos después de la edición
    $sql = "SELECT * FROM articulos";
    $consulta = $conexion->query($sql);

    // Obtener los datos de los artículos
    $articulos = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar cualquier error de la base de datos
    echo '<p>Error al obtener los artículos: ' . $e->getMessage() . '</p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inventario.css">
    <script>
    function confirmDelete(id) {
        document.getElementById('delete_id').value = id;
        document.getElementById('deleteModal').style.display = 'block'; // Aquí se muestra el modal de borrado
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none'; // Aquí se oculta el modal de borrado
        document.getElementById('editModal').style.display = 'none'; // Aquí se oculta el modal de edición
        location.reload(); // Recargar la página después de cerrar el modal
    }

    function editArticle(id, nombre, precio, imagen, descripcion, material, categoria) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_precio').value = precio;
        document.getElementById('edit_descripcion').value = descripcion;
        document.getElementById('edit_material').value = material;
        document.getElementById('edit_categoria').value = categoria;
        
        // Eliminar la línea que establece el valor del campo de imagen para evitar problemas
        // con el tipo de entrada de archivo (input type="file")
        
        document.getElementById('editModal').style.display = 'block'; // Aquí se muestra el modal de edición
    }

    </script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Panel de administrador</h2>
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
            <header class="header"></header>
            <section class="content">
                <?php if (isset($articulos) && !empty($articulos)) : ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Descripción</th>
                                    <th>Material</th>
                                    <th>Categoría</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($articulos as $articulo) : ?>
                                    <tr>
                                        <td><?php echo $articulo['id']; ?></td>
                                        <td><?php echo $articulo['nombre']; ?></td>
                                        <td><?php echo $articulo['precio']; ?></td>
                                        <td><img src="<?php echo $articulo['imagen']; ?>" alt="Imagen de <?php echo $articulo['nombre']; ?>" width="50"></td>
                                        <td><?php echo $articulo['descripcion']; ?></td>
                                        <td><?php echo $articulo['material']; ?></td>
                                        <td><?php echo $articulo['categoria']; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="editArticle('<?php echo $articulo['id']; ?>', '<?php echo $articulo['nombre']; ?>', '<?php echo $articulo['precio']; ?>', '<?php echo $articulo['imagen']; ?>', '<?php echo $articulo['descripcion']; ?>', '<?php echo $articulo['material']; ?>', '<?php echo $articulo['categoria']; ?>')">
                                                <img src="img/editt.png" alt="Editar">
                                            </a>
                                            <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $articulo['id']; ?>')">
                                                <img src="img/eliminarr.png" alt="Eliminar">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p>No hay artículos registrados en el inventario.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <!-- Modales -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>¿Estás seguro de que deseas borrar este artículo?</h2>
            <form action="inventario.php" method="post">
                <input type="hidden" name="delete_id" id="delete_id">
                <button type="submit">Borrar</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>
    <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Editar Artículo</h2>
        <form action="inventario.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit_id">
            <label for="edit_nombre">Nombre:</label>
            <input type="text" name="nombre" id="edit_nombre" required>
            <label for="edit_precio">Precio:</label>
            <input type="text" name="precio" id="edit_precio" required>
            <label for="edit_imagen">Imagen:</label>
            <input type="file" name="nueva_imagen" id="nueva_imagen" accept="image/*"> <!-- Cambiado a tipo file para permitir la carga de una nueva imagen -->
            <label for="edit_descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="edit_descripcion" required>
            <label for="edit_material">Material:</label>
            <input type="text" name="material" id="edit_material" required>
            <label for="edit_categoria">Categoría:</label>
            <input type="text" name="categoria" id="edit_categoria" required>
            <button type="submit">Guardar Cambios</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

</body>
</html>
