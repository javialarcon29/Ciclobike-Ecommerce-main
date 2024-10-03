<?php
session_start();

if (isset($_POST['producto_id']) && isset($_POST['producto_nombre']) && isset($_POST['producto_precio']) && isset($_POST['producto_imagen'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['producto_nombre'];
    $precio = $_POST['producto_precio'];
    $imagen = $_POST['producto_imagen'];
    $cantidad = 1;

    $producto_existente = false;

    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $item) {
            if ($item['id'] === $producto_id) {
                $_SESSION['carrito'][$key]['cantidad'] += $cantidad;
                $producto_existente = true;
                break;
            }
        }
    }

    if (!$producto_existente) {
        $producto = array(
            'id' => $producto_id,
            'nombre' => $nombre,
            'precio' => $precio,
            'imagen' => $imagen,
            'cantidad' => 1
        );
        $_SESSION['carrito'][] = $producto;
    }

    echo json_encode(['status' => 'success', 'message' => 'Producto añadido al carrito']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos de producto incompletos']);
}
?>
