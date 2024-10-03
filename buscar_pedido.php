<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/buscar.css">
<style>
.btn {
  display: inline-block;
  padding: 10px 20px;
  margin-top: 20px;
  text-decoration: none;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
}



</style>


</head>
<body>
   
​<div class="row shop-tracking-status">

  <div class="col-md-12">
    <div class="well">

     

      <h1>ESTADO DE TU PEDIDO:</h1>

      <?php
// Verificar que se ha enviado un ID de pedido por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pedido-id"])) {
    $pedido_id = $_POST["pedido-id"];

    // Conexión a la base de datos (reemplaza los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyect";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para buscar el pedido por ID
    $sql = "SELECT * FROM pedidos WHERE id_pedido = '$pedido_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div style="text-align: center;">'; // Inicio de la tabla centrada
        echo '<h2>Información del Pedido</h2>';
        echo '<table style="margin: 0 auto;">'; // Estilo para centrar la tabla
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><strong>ID de Pedido:</strong></td>';
            echo '<td>' . $row["id_pedido"] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><strong>Nombre:</strong></td>';
            echo '<td>' . $row["nombre"] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><strong>Dirección:</strong></td>';
            echo '<td>' . $row["direccion"] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><strong>Método de Pago:</strong></td>';
            echo '<td>' . $row["metodo_pago"] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><strong>Total:</strong></td>';
            echo '<td>' . $row["total"] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><strong>Fecha de Pedido:</strong></td>';
            echo '<td>' . $row["fecha_pedido"] . '</td>';
            echo '</tr>';
            echo '<td><strong>Estado:</strong></td>';
            echo '<td>' . $row["estado"] . '</td>';
            echo '</tr>';
        }
        echo '</table>'; // Fin de la tabla
        echo '</div>'; // Fin de la div centrada
    } else {
        echo "<p>No se encontró ningún pedido con ese ID.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "<p>Por favor, ingresa un ID de pedido válido.</p>";
}
?>



      <div class="order-status">

        <div class="order-status-timeline">
          <!-- class names: c0 c1 c2 c3 and c4 -->
          <div class="order-status-timeline-completion c1"></div>
        </div>

        <div class="image-order-status image-order-status-new active img-circle">
          <span class="status">Aceptado</span>
          <div class="icon"></div>
        </div>
        <div class="image-order-status image-order-status-active active img-circle">
          <span class="status">En proceso</span>
          <div class="icon"></div>
        </div>
        <div class="image-order-status image-order-status-intransit active img-circle">
          <span class="status">Almacenado</span>
          <div class="icon"></div>
        </div>
        <div class="image-order-status image-order-status-delivered active img-circle">
          <span class="status">En reparto</span>
          <div class="icon"></div>
        </div>
        <div class="image-order-status image-order-status-completed active img-circle">
          <span class="status">Completado</span>
          <div class="icon"></div>
        </div>

      </div>
    </div>
  </div>

</div>


<!-- Botón para volver a index.php -->
<div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="btn btn-primary">Volver</a>
</div>


</body>
</html>