<?php
session_start();

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        echo '<li>';
        echo '<img src="' . htmlspecialchars($item['imagen']) . '" alt="' . htmlspecialchars($item['nombre']) . '">';
        echo '<span>' . htmlspecialchars($item['nombre']) . '</span>';
        echo '<span>' . htmlspecialchars($item['cantidad']) . ' x €' . htmlspecialchars($item['precio']) . '</span>';
        echo '</li>';
    }
    echo '<a href="carrito.php" class="ver-carrito-btn">Ver carrito</a>';
} else {
    echo '<p>Tu carrito está vacío</p>';
}
?>
