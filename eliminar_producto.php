<?php
session_start();

if (isset($_POST['eliminar_producto'])) {
    $key = $_POST['eliminar_producto'];
    if (isset($_SESSION['carrito'][$key])) {
        unset($_SESSION['carrito'][$key]);
    }
}
?>
