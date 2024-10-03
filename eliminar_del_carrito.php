<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['indice'])) {
    $indice = $_POST['indice'];

    if (isset($_SESSION['carrito'][$indice])) {
        unset($_SESSION['carrito'][$indice]);

        // Reindexar el array para evitar problemas con índices no consecutivos
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
