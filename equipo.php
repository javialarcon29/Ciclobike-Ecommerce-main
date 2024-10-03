<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sobre Nosotros - Ciclo Bike Málaga</title>
<?php require 'head_cliente_inicio.php'; ?>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/227389/bg.jpg") #fff;
        margin: 0;
        padding: 0;
        color: #333;
    }
    .container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
        font-size: 2.5em;
        margin-bottom: 20px;
    }
    .about-section {
        text-align: center;
        padding: 50px;
        background-color: #f1f1f1;
        border-radius: 8px;
        margin-bottom: 40px;
    }
    .about-section h2 {
        margin-top: 0;
        font-size: 2em;
        color: #444;
    }
    .about-section p {
        color: #666;
        line-height: 1.8;
        font-size: 1.1em;
        margin: 20px auto;
        max-width: 800px;
    }
    .team-section {
        padding: 50px 0;
    }
    .team-section h2 {
        text-align: center;
        font-size: 2em;
        color: #444;
        margin-bottom: 40px;
    }
    .team-member {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
    }
    .team-member img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        border: 4px solid #ddd;
    }
    .team-member .info {
        max-width: 600px;
    }
    .team-member h3 {
        margin-top: 0;
        font-size: 1.5em;
        color: #333;
    }
    .team-member p {
        margin-bottom: 10px;
        color: #666;
        font-size: 1.1em;
    }
    .cta-section {
        text-align: center;
        padding: 50px;
        background-color: #f9f9f9;
        border-radius: 8px;
        margin-top: 40px;
    }
    .cta-section h2 {
        font-size: 2em;
        margin-bottom: 20px;
        color: #444;
    }
    .cta-section p {
        font-size: 1.2em;
        color: #666;
        margin-bottom: 30px;
    }
    .cta-section a {
        text-decoration: none;
        background-color: #007BFF;
        color: #fff;
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 1.1em;
        transition: background-color 0.3s;
    }
    .cta-section a:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Sobre Nosotros</h1>
    <div class="about-section">
        <h2>Bienvenidos a Ciclo Bike Málaga</h2>
        <p>En Ciclo Bike Málaga, somos apasionados del ciclismo y estamos dedicados a proporcionar las mejores bicicletas y accesorios a nuestros clientes. Fundada en 2010, nuestra misión es promover el ciclismo como una forma de vida saludable y sostenible. Ofrecemos una amplia gama de productos de alta calidad, desde bicicletas de carretera hasta bicicletas de montaña y eléctricas, adaptadas a las necesidades de cada ciclista.</p>
    </div>
    <div class="team-section">
        <h2>Conoce a Nuestro Equipo</h2>
        <div class="team-member">
            <img src="img/hombre1.jpg" alt="Juan Pérez">
            <div class="info">
                <h3>Juan Pérez</h3>
                <p>Cargo: Gerente de Ventas</p>
                <p>Experiencia en el sector ciclista desde 2010.</p>
            </div>
        </div>
        <div class="team-member">
            <img src="img/hombre2.jpg" alt="Laura Gómez">
            <div class="info">
                <h3>Laura Gómez</h3>
                <p>Cargo: Ingeniera de Producto</p>
                <p>Experta en diseño y desarrollo de bicicletas desde 2005.</p>
            </div>
        </div>
        <div class="team-member">
            <img src="img/hombre3.jpg" alt="Carlos Ruiz">
            <div class="info">
                <h3>Carlos Ruiz</h3>
                <p>Cargo: Especialista en Atención al Cliente</p>
                <p>Apasionado por ayudar a nuestros clientes a encontrar la bicicleta perfecta desde 2012.</p>
            </div>
        </div>
    </div>
    <div class="cta-section">
        <h2>¿Listo para unirte a nuestra comunidad ciclista?</h2>
        <p>Explora nuestra tienda en línea y descubre la bicicleta perfecta para ti. Únete a nosotros y empieza tu aventura sobre dos ruedas hoy mismo.</p>
        <a href="catalogo.php">Visita Nuestra Tienda</a>
    </div>
</div>
<?php require 'footer.php'; ?>
</body>
</html>
