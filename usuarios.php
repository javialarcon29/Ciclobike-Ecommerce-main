<?php
// db.php - Archivo de conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto a tu nombre de usuario de la base de datos
$password = ""; // Cambia esto a tu contraseña de la base de datos
$dbname = "proyect";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $delete_sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $nombre = $_POST['nombre'];
        $primer_apellido = $_POST['primer_apellido'];
        $segundo_apellido = $_POST['segundo_apellido'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $rol = $_POST['rol'];

        $edit_sql = "UPDATE usuarios SET nombre = ?, primer_apellido = ?, segundo_apellido = ?, correo = ?, contrasena = ?, rol = ? WHERE id = ?";
        $stmt = $conn->prepare($edit_sql);
        $stmt->bind_param("sssssii", $nombre, $primer_apellido, $segundo_apellido, $correo, $contrasena, $rol, $edit_id);
        $stmt->execute();
        $stmt->close();
    }
}

$sql = "SELECT id, nombre, primer_apellido, segundo_apellido, correo, contrasena, rol FROM usuarios";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/usuarios.css">
    <script>
        function confirmDelete(id) {
            document.getElementById('delete_id').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            document.getElementById('editModal').style.display = 'none';
        }

        function editUser(id, nombre, primer_apellido, segundo_apellido, correo, contrasena, rol) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_primer_apellido').value = primer_apellido;
            document.getElementById('edit_segundo_apellido').value = segundo_apellido;
            document.getElementById('edit_correo').value = correo;
            document.getElementById('edit_contrasena').value = contrasena;
            document.getElementById('edit_rol').value = rol;
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
                <h1>Listado de Usuarios</h1>
            </header>
            <section class="content">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       
<?php if ($result->num_rows > 0) : ?>
    <?php while($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['primer_apellido']; ?></td>
            <td><?php echo $row['segundo_apellido']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['contrasena']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td>
                <a href="javascript:void(0);" onclick="editUser('<?php echo $row['id']; ?>', '<?php echo $row['nombre']; ?>', '<?php echo $row['primer_apellido']; ?>', '<?php echo $row['segundo_apellido']; ?>', '<?php echo $row['correo']; ?>', '<?php echo $row['contrasena']; ?>', '<?php echo $row['rol']; ?>')">
                    <img src="img/editt.png" alt="Editar">
                </a>
                <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $row['id']; ?>')">
                    <img src="img/eliminarr.png" alt="Eliminar">
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else : ?>
    <tr>
        <td colspan="8">No se encontraron usuarios</td>
    </tr>
<?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- Modal de confirmación de borrado -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirmar Borrado</h2>
            <p>¿Estás seguro de que deseas borrar este usuario?</p>
            <form method="POST" action="usuarios.php">
                <input type="hidden" name="delete_id" id="delete_id">
                <button type="submit">Sí, borrar</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- Modal de edición de usuario -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Editar Usuario</h2>
            <form method="POST" action="usuarios.php">
                <input type="hidden" name="edit_id" id="edit_id">
                <label for="edit_nombre">Nombre:</label>
                <input type="text" name="nombre" id="edit_nombre" required>
                <label for="edit_primer_apellido">Primer Apellido:</label>
                <input type="text" name="primer_apellido" id="edit_primer_apellido" required>
                <label for="edit_segundo_apellido">Segundo Apellido:</label>
                <input type="text" name="segundo_apellido" id="edit_segundo_apellido" required>
                <label for="edit_correo">Correo:</label>
                <input type="email" name="correo" id="edit_correo" required>
                <label for="edit_contrasena">Contraseña:</label>
                <input type="text" name="contrasena" id="edit_contrasena" required>
                <label for="edit_rol">Rol:</label>
                <input type="text" name="rol" id="edit_rol" required>
                <button type="submit">Guardar cambios</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
