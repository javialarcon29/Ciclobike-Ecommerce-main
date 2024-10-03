<?php
// Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
$dsn = 'mysql:host=localhost;dbname=proyect';
$usuario = 'root';
$contraseña = '';

try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar la consulta SQL para obtener los pedidos de la tabla
    $sql = "SELECT * FROM paypal_orders";
    $consulta = $conexion->query($sql);

    // Obtener los datos de los pedidos
    $pedidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar cualquier error de la base de datos
    echo '<p>Error al obtener los pedidos: ' . $e->getMessage() . '</p>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $delete_sql = "DELETE FROM paypal_orders WHERE payment_id = ?";
        $stmt = $conexion->prepare($delete_sql);
        $stmt->execute([$delete_id]);
    } elseif (isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $username2 = $_POST['username2'];
        $precio = $_POST['precio'];
        $create_time = $_POST['create_time'];
        $direccion = $_POST['direccion'];
        $provincia = $_POST['provincia'];
        $codigo_postal = $_POST['codigo_postal'];
        $ciudad = $_POST['ciudad'];
        $event_type = $_POST['event_type'];

        $edit_sql = "UPDATE paypal_orders SET user_email = ?, username = ?, username2 = ?, precio = ?, create_time = ?, direccion = ?, provincia = ?, codigo_postal = ?, ciudad = ?, event_type = ? WHERE payment_id = ?";
        $stmt = $conexion->prepare($edit_sql);
        $stmt->execute([$user_email, $username, $username2, $precio, $create_time, $direccion, $provincia, $codigo_postal, $ciudad, $event_type, $edit_id]);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/admin.css">
    <script>
        function confirmDelete(id) {
            document.getElementById('delete_id').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            document.getElementById('editModal').style.display = 'none';
        }

        function editOrder(id, user_email, username, username2, precio, create_time, direccion, provincia, codigo_postal, ciudad, event_type) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_user_email').value = user_email;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_username2').value = username2;
            document.getElementById('edit_precio').value = precio;
            document.getElementById('edit_create_time').value = create_time;
            document.getElementById('edit_direccion').value = direccion;
            document.getElementById('edit_provincia').value = provincia;
            document.getElementById('edit_codigo_postal').value = codigo_postal;
            document.getElementById('edit_ciudad').value = ciudad;
            document.getElementById('edit_event_type').value = event_type;
            document.getElementById('editModal').style.display = 'block';
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
            <header class="header">
                <h1>Pedidos realizados</h1>
            </header>
            <section class="content">
                <?php if (isset($pedidos) && !empty($pedidos)) : ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>User Email</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Precio</th>
                                    <th>Realización pedido</th>
                                    <th>Dirección</th>
                                    <th>Provincia</th>
                                    <th>Código Postal</th>
                                   
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido) : ?>
                                    <tr class="estado-<?php echo strtolower($pedido['event_type']); ?>">
                                        <td><?php echo $pedido['payment_id']; ?></td>
                                        <td><?php echo $pedido['user_email']; ?></td>
                                        <td><?php echo $pedido['username']; ?></td>
                                        <td><?php echo $pedido['username2']; ?></td>
                                        <td><?php echo $pedido['precio']; ?></td>
                                        <td><?php echo $pedido['create_time']; ?></td>
                                        <td><?php echo $pedido['direccion']; ?></td>
                                        <td><?php echo $pedido['provincia']; ?></td>
                                        <td><?php echo $pedido['codigo_postal']; ?></td>
                                      
                                        <td><?php echo $pedido['event_type']; ?></td>
                                        <td>
                                        <a href="javascript:void(0);" onclick="editOrder('<?php echo $pedido['payment_id']; ?>', '<?php echo $pedido['user_email']; ?>', '<?php echo $pedido['username']; ?>', '<?php echo $pedido['username2']; ?>', '<?php echo $pedido['precio']; ?>', '<?php echo $pedido['create_time']; ?>', '<?php echo $pedido['direccion']; ?>', '<?php echo $pedido['provincia']; ?>', '<?php echo $pedido['codigo_postal']; ?>', '<?php echo $pedido['ciudad']; ?>', '<?php echo $pedido['event_type']; ?>')">
    <img src="img/editt.png" alt="Editar">
</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $pedido['payment_id']; ?>')">
    <img src="img/eliminarr.png" alt="Eliminar">
</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p>No hay pedidos registrados.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <!-- Modal de confirmación de borrado -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirmar Borrado</h2>
            <p>¿Estás seguro de que deseas borrar este pedido?</p>
            <form method="POST" action="admin.php">
                <input type="hidden" name="delete_id" id="delete_id">
                <button type="submit">Sí, borrar</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- Modal de edición de pedido -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Editar Pedido</h2>
            <form method="POST" action="admin.php" onsubmit="reloadPage()"> <!-- Agrega onsubmit="reloadPage()" aquí -->
                <input type="hidden" name="edit_id" id="edit_id">
                <label for="edit_user_email">User Email:</label>
                <input type="text" name="user_email" id="edit_user_email" required>
                <label for="edit_username">Nombre:</label>
                <input type="text" name="username" id="edit_username" required>
                <label for="edit_username2">Apellido:</label>
                <input type="text" name="username2" id="edit_username2" required>
                <label for="edit_precio">Precio:</label>
                <input type="text" name="precio" id="edit_precio" required>
                <label for="edit_create_time">Realización pedido:</label>
                <input type="text" name="create_time" id="edit_create_time" required>
                <label for="edit_direccion">Dirección:</label>
                <input type="text" name="direccion" id="edit_direccion" required>
                <label for="edit_provincia">Provincia:</label>
                <input type="text" name="provincia" id="edit_provincia" required>
                <label for="edit_codigo_postal">Código Postal:</label>
                <input type="text" name="codigo_postal" id="edit_codigo_postal" required>
                <label for="edit_ciudad">Ciudad:</label>
                <input type="text" name="ciudad" id="edit_ciudad" required>
                <label for="edit_event_type">Estado:</label>
                <input type="text" name="event_type" id="edit_event_type" required>
                <button type="submit">Guardar Cambios</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
    function reloadPage() {
        window.location.reload(); // Recargar la página actual
    }
</script>

</body>
</html>
