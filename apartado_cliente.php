<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    height: 100vh;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #343a40;
    color: #fff;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.sidebar-header {
    padding: 20px;
    background-color: #23272b;
    text-align: center;
}

.sidebar-header h2 {
    margin: 0;
    font-size: 24px;
}

.menu {
    flex-grow: 1;
}

.menu ul {
    list-style-type: none;
    padding: 0;
}

.menu ul li {
    width: 100%;
}

.menu ul li a {
    display: block;
    padding: 15px 20px;
    color: #fff;
    text-decoration: none;
    transition: background 0.3s;
}

.menu ul li a:hover {
    background-color: #495057;
}

.main-content {
    flex-grow: 1;
    background-color: #f8f9fa;
    display: flex;
    flex-direction: column;
}

.header {
    padding: 20px;
    background-color: #e9ecef;
    border-bottom: 1px solid #dee2e6;
}

.header h1 {
    margin: 0;
    font-size: 28px;
}

.content {
    padding: 20px;
}
</style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
            <h2>Panel de administrador </h2>
            </div>
            <nav class="menu">
                <ul>
                <li><a href="admin.php">Pedidos</a></li>
                    <li><a href="usuarios.php">Listado de usuarios</a></li>
                    <li><a href="inventario.php">Inventario Artículos</a></li>
                    <li><a href="index.php">Salir</a></li>

                </ul>
            </nav>
        </aside>
        <main class="main-content">
    <header class="header">
        <h1>Bienvenido al Panel de Administración</h1>
    </header>
    <section class="content">
        <img src="img/admini.png" alt="Administración" style="display: block; margin: 0 auto;">
    </section>
</main>

    </div>
</body>
</html>
